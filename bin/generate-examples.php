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

$yaml = Yaml::parse(
    file_get_contents(__DIR__ . '/openapi.yaml')
);

$docsDir = __DIR__ . '/../docs';

if (!is_dir($docsDir)) {
    echo 'Docs directory does not exist';
    exit;
}

function getReplaceString(string $operationId): string
{
    return "REPLACE_ME_WITH_EXAMPLE_FOR__{$operationId}__CODE";
}

function replaceInDirectory(
    string $directory,
    array $codeSamples
): void {
    /** @var DirectoryIterator $fileInfo */
    foreach (new DirectoryIterator($directory) as $fileInfo) {
        if (
            $fileInfo->isDir()
            || $fileInfo->isDot()
            || $fileInfo->getExtension() !== 'md'
        ) {
            continue;
        }

        replaceInFile($fileInfo->getPathname(), $codeSamples);
    }
}

function replaceInFile(string $filepath, array $codeSamples): void
{
    $contents = file_get_contents($filepath);

    foreach ($codeSamples as $operationId => $codeSample) {
        $toReplace = getReplaceString($operationId);

        $contents = str_replace(
            $toReplace,
            $codeSample['source'],
            $contents,
        );
    }

    $search = "/(REPLACE_ME_WITH_DESCRIPTION_BEGIN)([\s\S][^|]*)(REPLACE_ME_WITH_DESCRIPTION_END)/";
    $contents = preg_replace_callback(
        $search,
        function ($matches) {
            $edited = str_replace("\n\n", '<br><br>', $matches[2]);
            // Handles bullet lists
            $edited = str_replace("\n*", '<br>*', $edited);
            $edited = str_replace("\n", ' ', $edited);

            return $edited;
        },
        $contents,
    );

    $contents = str_replace('&#x60;', '`', $contents);

    /**
     * openapi-generator considers
     * `\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]` to be a primitive
     * type so it does not create a link to the doc file.
     */
    $contents = str_replace(
        '```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]```',
        '[```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]```](SubFormFieldsPerDocumentBase.md)',
        $contents,
    );

    file_put_contents($filepath, $contents);
}

$codeSamples = [];

foreach ($yaml['paths'] as $paths) {
    foreach ($paths as $action) {
        if (empty($action['x-codeSamples'])) {
            continue;
        }

        foreach ($action['x-codeSamples'] as $sample) {
            if ($sample['lang'] !== 'PHP') {
                continue;
            }

            $codeSamples[$action['operationId']] = $sample;
            break;
        }
    }
}

replaceInDirectory("{$docsDir}/Api", $codeSamples);
replaceInDirectory("{$docsDir}/Model", $codeSamples);
replaceInFile(__DIR__ . '/../README.md', $codeSamples);
