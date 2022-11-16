#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

set_error_handler(function ($level, $msg) {
    echo "Error: {$msg}";
    exit(1);
});

/**
 * Read code samples and unescaped descriptions from OAS file and injects the
 * data into Markdown documentation.
 *
 * When openapi-generator generates the SDK code, all markdown documentation
 * files will contain escaped descriptions for method parameters. This is due
 * to parameter documentation existing within markdown tables, surrounded by
 * pipes `|`. Markdown table rows must contain all data in a single line, but
 * unescaped descriptions will often contain linebreaks, list items, etc, that
 * cannot correctly be displayed in markdown tables.
 *
 * This tool replaces linebreaks with `<br>`, fixes list items, fixes broken
 * anchor links for specific parameter definitions.
 */
class GenerateExamples
{
    /**
     * @var Array<string, string>
     */
    protected array $codeSamples = [];

    /**
     * openapi-generator considers array of array of object to be a primitive
     * type so it does not create a link to the doc file.
     *
     * Array<string, string>
     */
    protected array $extraReplace = [];

    /**
     * Languages of the code samples we are looking for. Usually will be a single
     * language, ["PHP"], but the javascript SDK can generate both typescript and
     * javascript.
     *
     * @var string[]
     */
    protected array $languages = [];

    /**
     * Our OAS in array form
     *
     * @var array
     */
    protected array $openapi;

    /**
     * Search and replace all files in these directories
     *
     * @var string[]
     */
    protected array $replaceInDirectories = [];

    /**
     * Target specific files for search and replace
     *
     * @var string[]
     */
    protected array $replaceInFiles = [];

    protected bool $useSnakeCase = false;

    public function __construct(
        array $openapi,
        array $languages,
        array $replaceInDirectories,
        array $replaceInFiles,
        array $extraReplace = []
    ) {
        $this->openapi = $openapi;
        $this->languages = $languages;
        $this->replaceInDirectories = $replaceInDirectories;
        $this->replaceInFiles = $replaceInFiles;
        $this->extraReplace = $extraReplace;
    }

    public function setUseSnakeCase(bool $flag): void
    {
        $this->useSnakeCase = $flag;
    }

    public function run(): void
    {
        $this->getCodeSamples();

        foreach ($this->replaceInDirectories as $directory) {
            $this->replaceInDirectory($directory);
        }

        foreach ($this->replaceInFiles as $file) {
            $this->replaceInFile($file);
        }
    }

    /**
     * Reads OAS file and grabs code samples related to chosen languages,
     * defined in Redocly's custom `x-codeSamples` spec extension:
     *
     * x-codeSamples:
         -
           lang: PHP
           label: PHP
           source:
             $ref: examples/AccountCreate.php
     *
     * @return void
     * @see https://redoc.ly/docs/api-reference-docs/specification-extensions/x-code-samples/
     */
    protected function getCodeSamples(): void
    {
        foreach ($this->openapi['paths'] as $paths) {
            foreach ($paths as $action) {
                if (empty($action['x-codeSamples'])) {
                    continue;
                }

                foreach ($action['x-codeSamples'] as $sample) {
                    if (!in_array($sample['lang'], $this->languages, true)) {
                        continue;
                    }

                    $id = $action['operationId'];

                    if (empty($this->codeSamples[$id])) {
                        $this->codeSamples[$id] = [];
                    }

                    $contents = file_get_contents(
                        __DIR__ . "/../{$sample['source']['$ref']}"
                    );

                    $this->codeSamples[$id][$sample['lang']] = $contents;
                }
            }
        }
    }

    /**
     * Scans provided directories for markdown (.md) files to inject code
     * samples and documentation into
     *
     * @param string $directory
     * @return void
     */
    protected function replaceInDirectory(string $directory): void
    {
        /** @var DirectoryIterator $fileInfo */
        foreach (new DirectoryIterator($directory) as $fileInfo) {
            if (
                $fileInfo->isDir()
                || $fileInfo->isDot()
                || $fileInfo->getExtension() !== 'md'
            ) {
                continue;
            }

            $this->replaceInFile($fileInfo->getPathname());
        }
    }

    /**
     * Injects code samples into provided files. Not limited to markdown (.md)
     * files, can be anything. But usually markdown files.
     *
     * @param string $filepath
     * @return void
     */
    protected function replaceInFile(string $filepath): void
    {
        $fileContents = file_get_contents($filepath);

        $fileContents = $this->replaceCodeSample($fileContents);
        $fileContents = $this->replaceDocumentation($fileContents);

        file_put_contents($filepath, $fileContents);
    }

    protected function replaceCodeSample(string $fileContents): string
    {
        foreach ($this->codeSamples as $operationId => $codeSamples) {
            foreach ($codeSamples as $language => $codeSample) {
                $toReplace = $this->getReplaceCodeString($operationId, $language);

                $fileContents = str_replace(
                    $toReplace,
                    $codeSample,
                    $fileContents,
                );
            }
        }

        return $fileContents;
    }

    public function replaceDocumentation(string $fileContents): string
    {
        $search = "/(REPLACE_ME_WITH_DESCRIPTION_BEGIN)([\s\S][^|]*)(REPLACE_ME_WITH_DESCRIPTION_END)/";
        $fileContents = preg_replace_callback(
            $search,
            function ($matches) {
                $edited = str_replace("\n\n", '<br><br>', $matches[2]);
                // Handles bullet lists
                $edited = str_replace("\n*", '<br>*', $edited);
                $edited = str_replace("\n", ' ', $edited);

                return $edited;
            },
            $fileContents,
        );

        $fileContents = str_replace('&#x60;', '`', $fileContents);

        foreach ($this->extraReplace as $k => $v) {
            $fileContents = str_replace($k, $v, $fileContents, );
        }

        return $fileContents;
    }

    /**
     * Our templates initially generate markdown documentation files with
     * REPLACE_ME_WITH_EXAMPLE_FOR__{{{operationId}}}_{language}_CODE
     * in place of the actual auto-generated examples that openapi-generator
     * would usually generate.
     *
     * We simply search for this string and replace with associated code sample.
     *
     * Ex: REPLACE_ME_WITH_EXAMPLE_FOR__accountCreate_PHP_CODE
     *
     * @param string $operationId
     * @param string $language
     * @return string
     */
    protected function getReplaceCodeString(
        string $operationId,
        string $language
    ): string {
        $operationId = $this->useSnakeCase
            ? strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $operationId))
            : $operationId;

        return "REPLACE_ME_WITH_EXAMPLE_FOR__{$operationId}_{$language}_CODE";
    }
}

$generate = new GenerateExamples(
    Yaml::parse(file_get_contents(__DIR__ . '/../openapi-sdk.yaml')),
    ['PHP'],
    [__DIR__ . '/../docs/Api', __DIR__ . '/../docs/Model'],
    [__DIR__ . '/../README.md'],
);
$generate->setUseSnakeCase(false);

$generate->run();
