<?php

namespace SurrealCristian\SnmpExtension\Command;

use SurrealCristian\SnmpExtension\Fn\FnSnmp2Get;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2GetParser;

class GetV2cCommand extends BaseCommand
{
    protected $fn;
    protected $parser;

    public function __construct(
        FnSnmp2Get $fn, FnSnmp2GetParser $parser
    ) {
        $this->fn = $fn;
        $this->parser = $parser;
    }
}
