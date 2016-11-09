<?php

namespace SurrealCristian\SnmpExtension\Command\Test;

use SurrealCristian\SnmpExtension\Command\GetV2cCommand;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2GetParser;

use PHPUnit_Framework_TestCase;

class GetV2cCommandTest extends PHPUnit_Framework_TestCase
{
    protected $fnMock;

    protected function setUp()
    {
        $this->fnMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Fn\FnSnmp2Get')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new GetV2cCommand(
            $this->fnMock, new FnSnmp2GetParser
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = 'STRING: "foo 00"';

        $this->fnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $oid = '1.2.3.0';

        $actual = $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 500000, 3);

        $expected = array(
            'oid' => '1.2.3.0',
            'type' => 'STRING',
            'value' => '"foo 00"',
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException Exception
     */
    public function testExecuteThrowsException()
    {
        $retval = false;

        $this->fnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 500000, 3);
    }
}
