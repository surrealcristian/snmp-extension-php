<?php

namespace SurrealCristian\SnmpExtension\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpExtension\Builder;
use SurrealCristian\SnmpExtension\SimpleSnmpV2c;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function testGetSimpleSnmpV2c()
    {
        $builder = new Builder();
        $snmp = $builder->getSimpleSnmpV2c();

        $this->assertInstanceOf(SimpleSnmpV2c::class, $snmp);
    }
}
