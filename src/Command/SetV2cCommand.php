<?php

namespace SurrealCristian\SnmpExtension\Command;

use SurrealCristian\SnmpExtension\Fn\FnSnmp2Set;

class SetV2cCommand
{
    protected $fn;

    public function __construct(FnSnmp2Set $fn)
    {
        $this->fn = $fn;
    }

    public function execute(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        $this->fn->execute(
            $host, $community, $oid, $type, $value, $timeout, $retries
        );
    }
}
