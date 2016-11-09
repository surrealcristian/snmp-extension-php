<?php

namespace SurrealCristian\SnmpExtension\Fn;

/**
 * @codeCoverageIgnore
 */
abstract class BaseFnSnmp2
{
    protected $errno;
    protected $errstr;

    protected function errorHandler($errno, $errstr)
    {
        $this->errno = $errno;
        $this->errstr = $errstr;
    }

    protected function clearError()
    {
        $this->errno = null;
        $this->errstr = null;
    }
}
