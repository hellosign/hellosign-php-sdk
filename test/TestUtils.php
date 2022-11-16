<?php

declare(strict_types=1);

namespace HelloSignSDK\Test;

use ArrayAccess;
use GuzzleHttp\Psr7;
use Psr\Http\Message\StreamInterface;

abstract class TestUtils
{
    public static function getFixtureData(string $filename): array
    {
        $name = explode('\\', $filename);
        $fixtureFile = array_pop($name);
        $contents = file_get_contents(
            __DIR__ . "/../test_fixtures/{$fixtureFile}.json"
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
