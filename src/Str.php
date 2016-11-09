<?php

namespace SurrealCristian\SnmpExtension;

class Str
{
    public static function contains($haystack, $needle)
    {
        if (strpos($haystack, $needle) !== false) {
            return true;
        }

        return false;
    }
}
