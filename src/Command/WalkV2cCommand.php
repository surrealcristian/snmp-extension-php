<?php

namespace SurrealCristian\SnmpExtension\Command;

use SurrealCristian\SnmpExtension\Fn\FnSnmp2RealWalk;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2RealWalkParser;

class WalkV2cCommand extends BaseCommand
{
    protected $fn;
    protected $parser;

    public function __construct(
        FnSnmp2RealWalk $fn, FnSnmp2RealWalkParser $parser
    ) {
        $this->fn = $fn;
        $this->parser = $parser;
    }
}
