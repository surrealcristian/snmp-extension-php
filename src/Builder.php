<?php

namespace SurrealCristian\SnmpExtension;

use SurrealCristian\SnmpExtension\Command\GetV2cCommand;
use SurrealCristian\SnmpExtension\Command\GetNextV2cCommand;
use SurrealCristian\SnmpExtension\Command\WalkV2cCommand;
use SurrealCristian\SnmpExtension\Command\BulkWalkV2cCommand;
use SurrealCristian\SnmpExtension\Command\SetV2cCommand;

use SurrealCristian\SnmpExtension\Fn\FnSnmp2Get;
use SurrealCristian\SnmpExtension\Fn\FnSnmp2GetNext;
use SurrealCristian\SnmpExtension\Fn\FnSnmp2RealWalk;
use SurrealCristian\SnmpExtension\Fn\FnSnmp2Set;

use SurrealCristian\SnmpExtension\Parser\FnSnmp2Parser;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2GetParser;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2RealWalkParser;

use SurrealCristian\SnmpExtension\SimpleSnmpV2c;

class Builder
{
    public function getSimpleSnmpV2c()
    {
        $fnSnmp2Parser = new FnSnmp2Parser;

        $cmdGet = new GetV2cCommand(
            new FnSnmp2Get($fnSnmp2Parser), new FnSnmp2GetParser
        );
        $cmdGetNext = new GetNextV2cCommand(
            new FnSnmp2GetNext($fnSnmp2Parser), new FnSnmp2GetParser
        );
        $cmdWalk = new WalkV2cCommand(
            new FnSnmp2RealWalk($fnSnmp2Parser), new FnSnmp2RealWalkParser
        );
        $cmdBulkWalk = new BulkWalkV2cCommand(
            new FnSnmp2RealWalk($fnSnmp2Parser), new FnSnmp2RealWalkParser
        );
        $cmdSet = new SetV2cCommand(
            new FnSnmp2Set($fnSnmp2Parser)
        );
        
        $simpleSnmpV2c = new SimpleSnmpV2c(
            $cmdGet, $cmdGetNext, $cmdWalk, $cmdBulkWalk, $cmdSet
        );

        return $simpleSnmpV2c;
    }
}
