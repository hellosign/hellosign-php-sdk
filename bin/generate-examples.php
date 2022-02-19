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

class GenerateExamples
{
    protected const YAML_FILE = __DIR__ . '/../oas/openapi.yaml';

    protected array $codeSamples = [];

    protected array $extraReplace = [];

    protected array $languages = [];

    protected array $replaceInDirectories = [];

    protected array $replaceInFiles = [];

    protected array $yaml;

    public function __construct(
        array $languages,
        array $replaceInDirectories,
        array $replaceInFiles,
        array $extraReplace = []
    ) {
        $this->languages = $languages;
        $this->replaceInDirectories = $replaceInDirectories;
        $this->replaceInFiles = $replaceInFiles;
        $this->extraReplace = $extraReplace;
        $this->yaml = Yaml::parse(file_get_contents(self::YAML_FILE));
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

    protected function getCodeSamples(): void
    {
        foreach ($this->yaml['paths'] as $paths) {
            foreach ($paths as $action) {
                if (empty($action['x-codeSamples'])) {
                    continue;
                }

                foreach ($action['x-codeSamples'] as $sample) {
                    if (!in_array($sample['lang'], $this->languages, true)) {
                        continue;
                    }

                    $contents = file_get_contents(
                        __DIR__ . "/../{$sample['source']['$ref']}"
                    );

                    $this->codeSamples[$action['operationId']] = [
                        $sample['lang'] => $contents,
                    ];

                    break;
                }
            }
        }
    }

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

    protected function replaceInFile(string $filepath): void
    {
        $fileContents = file_get_contents($filepath);

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

        /*
         * openapi-generator considers
         * array of array of object to be a primitive
         * type so it does not create a link to the doc file.
         */
        foreach ($this->extraReplace as $k => $v) {
            $fileContents = str_replace($k, $v, $fileContents, );
        }

        file_put_contents($filepath, $fileContents);
    }

    protected function getReplaceCodeString(
        string $operationId,
        string $language
    ): string {
        return "REPLACE_ME_WITH_EXAMPLE_FOR__{$operationId}_{$language}_CODE";
    }
}

$generate = new GenerateExamples(
    ['PHP'],
    [__DIR__ . '/../docs/Api', __DIR__ . '/../docs/Model'],
    [__DIR__ . '/../README.md'],
    [
        '```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]```' => '[```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]```](SubFormFieldsPerDocumentBase.md)',
    ]
);

$generate->run();
