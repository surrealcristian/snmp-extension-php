<?php

namespace SurrealCristian\SnmpExtension\Command;

use SurrealCristian\SnmpExtension\Fn\FnSnmp2GetNext;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2GetParser;

class GetNextV2cCommand
{
    protected $fn;
    protected $parser;

    public function __construct(
        FnSnmp2GetNext $fn, FnSnmp2GetParser $parser
    ) {
        $this->fn = $fn;
        $this->parser = $parser;
    }

    public function execute($host, $community, $oid, $timeout, $retries)
    {
        $fnret = $this->fn->execute(
            $host, $community, $oid, $timeout, $retries
        );

        $ret = $this->parser->parse($fnret);

        return $ret;
    }
}
