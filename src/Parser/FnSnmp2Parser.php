<?php

namespace SurrealCristian\SnmpExtension\Parser;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;
use SurrealCristian\SimpleSnmp\Exception\TimeoutException;
use SurrealCristian\SnmpExtension\Str;

class FnSnmp2Parser
{
    public function parse($fnret, $errno, $errstr)
    {
        if ($fnret === false) {
            if (Str::contains($errstr, 'No response from')) {

                throw new TimeoutException();
            }

            $msg = "errno: $errno, errstr: $errstr";

            throw new SimpleSnmpException($msg);
        }
    }
}
