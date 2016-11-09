<?php

namespace SurrealCristian\SnmpExtension\Fn;

use SurrealCristian\SnmpExtension\Parser\FnSnmp2Parser;

/**
 * @codeCoverageIgnore
 */
class FnSnmp2Set extends BaseFnSnmp2
{
    public function __construct(FnSnmp2Parser $parser)
    {
        $this->parser = $parser;
    }

    public function execute(
        $host, $community, $objectId, $type, $value, $timeout, $retries
    ) {
        set_error_handler([$this, 'errorHandler']);
        $ret = snmp2_set(
            $host, $community, $objectId, $type, $value, $timeout, $retries
        );
        restore_error_handler();

        $errno = $this->errno;
        $errstr = $this->errstr;

        $this->clearError();

        $this->parser->parse($ret, $errno, $errstr);

        return $ret;
    }
}
