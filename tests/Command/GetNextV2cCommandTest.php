<?php

namespace SurrealCristian\SnmpExtension\Command\Test;

use SurrealCristian\SnmpExtension\Command\GetNextV2cCommand;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2GetParser;

use PHPUnit_Framework_TestCase;

class GetNextV2cCommandTest extends PHPUnit_Framework_TestCase
{
    protected $fnMock;

    protected function setUp()
    {
        $this->fnMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Fn\FnSnmp2GetNext')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new GetNextV2cCommand(
            $this->fnMock, new FnSnmp2GetParser
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = 'STRING: "foo 01"';

        $this->fnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $actual = $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 500000, 3);

        $expected = array(
            'oid' => null,
            'type' => 'STRING',
            'value' => '"foo 01"',
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
