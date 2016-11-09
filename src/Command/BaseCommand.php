<?php

namespace SurrealCristian\SnmpExtension\Command;

abstract class BaseCommand
{
    protected $fn;
    protected $parser;

    public function execute($host, $community, $oid, $timeout, $retries)
    {
        $fnret = $this->fn->execute(
            $host, $community, $oid, $timeout, $retries
        );

        $ret = $this->parser->parse($fnret, $oid);

        return $ret;
    }
}
