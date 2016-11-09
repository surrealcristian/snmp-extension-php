<?php

namespace SurrealCristian\SnmpExtension\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpExtension\SimpleSnmpV2c;
use SurrealCristian\SnmpExtension\GetV2cCommand;
use SurrealCristian\SnmpExtension\GetNextV2cCommand;
use SurrealCristian\SnmpExtension\WalkV2cCommand;
use SurrealCristian\SnmpExtension\BulkWalkV2cCommand;
use SurrealCristian\SnmpExtension\SetV2cCommand;

class SimpleSnmpV2cTest extends PHPUnit_Framework_TestCase
{
    protected $getV2cCommandMock;
    protected $getNextV2cCommandMock;
    protected $walkV2cCommandMock;
    protected $bulkWalkV2cCommandMock;
    protected $setV2cCommandMock;

    protected function setUp()
    {
        $this->getV2cCommandMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Command\GetV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $this->getNextV2cCommandMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Command\GetNextV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $this->walkV2cCommandMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Command\WalkV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $this->bulkWalkV2cCommandMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Command\BulkWalkV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $this->setV2cCommandMock = $this->getMockBuilder('SurrealCristian\SnmpExtension\Command\SetV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new SimpleSnmpV2c(
            $this->getV2cCommandMock,
            $this->getNextV2cCommandMock,
            $this->walkV2cCommandMock,
            $this->bulkWalkV2cCommandMock,
            $this->setV2cCommandMock
        );

        return $obj;
    }

    public function testGet()
    {
        $retval = array(
            'oid' => '1.2.3.0',
            'type' => 'STRING',
            'value' => '"foo bar"',
        );

        $this->getV2cCommandMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $snmp = $this->get();

        $actual = $snmp->get(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $this->assertEquals($retval, $actual);
    }

    public function testGetNext()
    {
        $retval = array(
            'oid' => '1.2.3.1',
            'type' => 'STRING',
            'value' => '"foo bar"',
        );

        $this->getNextV2cCommandMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $snmp = $this->get();

        $actual = $snmp->getNext(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $this->assertEquals($retval, $actual);
    }

    public function testWalk()
    {
        $retval = array(
            array(
                'oid' => '1.2.3.0',
                'type' => 'STRING',
                'value' => '"foo bar 00"',
            ),
            array(
                'oid' => '1.2.3.1',
                'type' => 'STRING',
                'value' => '"foo bar 01"',
            ),
        );

        $this->walkV2cCommandMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $snmp = $this->get();

        $actual = $snmp->walk(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $this->assertEquals($retval, $actual);
    }

    public function testBulkWalk()
    {
        $retval = array(
            array(
                'oid' => '1.2.3.0',
                'type' => 'STRING',
                'value' => '"foo bar 00"',
            ),
            array(
                'oid' => '1.2.3.1',
                'type' => 'STRING',
                'value' => '"foo bar 01"',
            ),
        );

        $this->bulkWalkV2cCommandMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $snmp = $this->get();

        $actual = $snmp->bulkWalk(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $this->assertEquals($retval, $actual);
    }

    public function testSet()
    {
        $this->setV2cCommandMock
            ->method('execute')
            ->will($this->returnValue(null));

        $snmp = $this->get();

        $actual = $snmp->set(
            '127.0.0.1', 'private', '.1.2.3.0', 's', 'test', 500000, 3
        );

        $this->assertEquals(null, $actual);
    }
}
