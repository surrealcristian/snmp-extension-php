<?php

namespace SurrealCristian\SnmpExtension\Parser;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;

class FnSnmp2RealWalkParser
{
    protected $patternTypeOptValue;

    public function __construct()
    {
        $this->patternTypeOptValue = '/^((?<type>[a-zA-Z0-9-]+): ){0,1}(?<value>.*)$/s';
    }

    public function parse($fnret, $oid)
    {
        if ($fnret === false) {
            throw new SimpleSnmpException();
        }

        $ret = array();

        foreach ($fnret as $key => $oidvalue) {
            $oid = trim($key, '.');

            $matches = array();
            $tmp = preg_match($this->patternTypeOptValue, $oidvalue, $matches);

            $type = ($matches['type'] !== '')
                ? $matches['type']
                : null;

            $value = $matches['value'];

            $ret[] = array(
                'oid' => $oid,
                'type' => $type,
                'value' => $value,
            );
        }

        return $ret;
    }
}
