<?php

namespace SurrealCristian\SnmpExtension\Command\Test;

use SurrealCristian\SnmpExtension\Command\WalkV2cCommand;
use SurrealCristian\SnmpExtension\Parser\FnSnmp2RealWalkParser;

use PHPUnit_Framework_TestCase;

class WalkV2cCommandTest extends PHPUnit_Framework_TestCase
{
    protected $fnMock;

    protected function setUp()
    {
        $this->fnMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Fn\FnSnmp2RealWalk')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new WalkV2cCommand(
            $this->fnMock, new FnSnmp2RealWalkParser
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = array(
            '.1.2.3.0.0' => 'STRING: "foo 00"',
            '.1.2.3.0.1' => 'STRING: "foo 01"',
        );

        $this->fnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $actual = $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 500000, 3);

        $expected = array(
            array(
                'oid' => '1.2.3.0.0',
                'type' => 'STRING',
                'value' => '"foo 00"',
            ),
            array(
                'oid' => '1.2.3.0.1',
                'type' => 'STRING',
                'value' => '"foo 01"',
            ),
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
