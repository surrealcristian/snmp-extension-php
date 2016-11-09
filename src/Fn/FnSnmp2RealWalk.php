<?php

namespace SurrealCristian\SnmpExtension\Fn;

use SurrealCristian\SnmpExtension\Parser\FnSnmp2Parser;

/**
 * @codeCoverageIgnore
 */
class FnSnmp2RealWalk extends BaseFnSnmp2
{
    public function __construct(FnSnmp2Parser $parser)
    {
        $this->parser = $parser;
    }

    public function execute($host, $community, $objectId, $timeout, $retries)
    {
        set_error_handler([$this, 'errorHandler']);
        $ret = snmp2_real_walk(
            $host, $community, $objectId, $timeout, $retries
        );
        restore_error_handler();

        $errno = $this->errno;
        $errstr = $this->errstr;

        $this->clearError();

        $this->parser->parse($ret, $errno, $errstr);

        return $ret;
    }
}
