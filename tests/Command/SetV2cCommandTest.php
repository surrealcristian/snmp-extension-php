<?php

namespace SurrealCristian\SnmpExtension\Command\Test;

use SurrealCristian\SnmpExtension\Command\SetV2cCommand;

use PHPUnit_Framework_TestCase;

class SetV2cCommandTest extends PHPUnit_Framework_TestCase
{
    protected $fnMock;

    protected function setUp()
    {
        $this->fnMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Fn\FnSnmp2Set')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new SetV2cCommand($this->fnMock);

        return $obj;
    }

    public function testExecute()
    {
        $this->fnMock
            ->method('execute')
            ->will($this->returnValue(null));

        $cmd = $this->get();

        $oid = '1.2.3.0';

        $actual = $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 's', 'foo bar', 500000, 3);

        $this->assertEquals(null, $actual);
    }
}
