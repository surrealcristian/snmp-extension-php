<?php

namespace SurrealCristian\SnmpExtension\Parser\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2Parser;

class FnSnmp2ParserTest extends PHPUnit_Framework_TestCase
{
    protected function get()
    {
        $obj = new FnSnmp2Parser;

        return $obj;
    }

    public function testParse()
    {
        $fnret = '1.2.3.0 = INTEGER: 77';

        $parser = $this->get();

        $actual = $parser->parse($fnret, null, null);

        $this->assertEquals(null, $actual);
    }

    /**
     * @expectedException SurrealCristian\SimpleSnmp\Exception\TimeoutException
     */
    public function testParseThrowsTimeoutException()
    {
        $fnret = false;
        $errno = 7;
        $errstr = 'snmp2_get(): No response from 127.0.0.1';

        $parser = $this->get();

        $parser->parse($fnret, $errno, $errstr);
    }

    /**
     * @expectedException SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException
     */
    public function testParseThrowsSimpleSnmpException()
    {
        $fnret = false;
        $errno = 7;
        $errstr = 'snmp2_get(): Other kind of error';

        $parser = $this->get();

        $parser->parse($fnret, $errno, $errstr);
    }
}
