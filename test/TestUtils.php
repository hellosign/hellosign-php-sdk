<?php

namespace HelloSignSDK\Test;

use ArrayAccess;
use GuzzleHttp\Psr7;
use HelloSignSDK\Configuration;
use Psr\Http\Message\StreamInterface;

abstract class TestUtils
{
    public const ROOT_FILE_PATH = __DIR__ . '/fixtures';

    public static function getFixtureData(string $filename): array
    {
        $name = explode('\\', $filename);
        $fixtureFile = array_pop($name);
        $contents = file_get_contents(
            self::ROOT_FILE_PATH . "/{$fixtureFile}.json"
        );

        return json_decode(
            $contents,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
    }

    /**
     * @param ArrayAccess|iterable $data
     */
    public static function toArray($data): array
    {
        return json_decode(json_encode($data), true);
    }

    /**
     * Using a non-absolute path filename will automatically prepend the
     * Configuration::getRootFilePath() value. Grab only the original
     * filename.
     *
     * @param ArrayAccess|iterable $data
     */
    public static function removeRootPathFromFiles($data): array
    {
        $rootPath = Configuration::getDefaultConfiguration()
            ->getRootFilePath();

        $result = [];

        foreach ($data as $key => $value) {
            if (empty($value)) {
                $result[$key] = $value;
                continue;
            }

            if (is_iterable($value)) {
                $result[$key] = self::removeRootPathFromFiles($value);
                continue;
            }

            if (!is_string($value)) {
                $result[$key] = $value;
                continue;
            }

            $result[$key] = trim(str_replace($rootPath, '', $value), '/');
        }

        return $result;
    }

    /**
     * @param StreamInterface|Psr7\MultipartStream $stream
     * @return array
     * @author https://stackoverflow.com/a/29926410/446766
     */
    public static function streamToArray(StreamInterface $stream)
    {
        $boundary = "--{$stream->getBoundary()}";
        $body = $stream->getContents();
        $body = str_replace("\r", '', $body);

        $parts = explode($boundary, $body);
        $result = [];

        foreach ($parts as $part) {
            /**
             * Now we need to parse the multi-part content. First match the
             * 'name=' parameter, then skip the double new-lines, match the
             * body and ignore the terminating new-line.
             * Using 's' flag enables .'s to match new lines.
             */
            $matched = preg_match(
                '/ name="?(?<key>[\w\[\]]+)".*?\n\n(?<value>.*?)\n$/s',
                $part,
                $matches
            );

            if ($matched) {
                $result[$matches['key']] = $matches['value'];
            }
        }

        return $result;
    }
}
