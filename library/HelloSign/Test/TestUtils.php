<?php

namespace HelloSign\Test;

class TestUtils
{
    /**
     * @param int|null $length
     * @return string
     */
    public static function generateGuid(?int $length = 40): string
    {
        $bytes = random_bytes((int) ceil($length / 2));
        $guid = bin2hex($bytes);

        return substr($guid, 0, $length);
    }
}
