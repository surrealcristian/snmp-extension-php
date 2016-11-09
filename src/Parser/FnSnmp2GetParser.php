<?php

namespace SurrealCristian\SnmpExtension\Parser;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;

class FnSnmp2GetParser
{
    protected $patternTypeOptValue;

    public function __construct()
    {
        $this->patternTypeOptValue = '/^((?<type>[a-zA-Z0-9-]+): ){0,1}(?<value>.*)$/s';
    }

    public function parse($fnret, $oid = null)
    {
        if ($fnret === false) {
            $msg = "Could not parse the value \"$fnret\"";
            throw new SimpleSnmpException();
        }

        if ($oid !== null) {
            $oid = trim($oid, '.');
        }

        $matches = array();
        $tmp = preg_match($this->patternTypeOptValue, $fnret, $matches);

        $type = ($matches['type'] !== '')
            ? $matches['type']
            : null;

        $value = $matches['value'];

        $ret = array(
            'oid' => $oid,
            'type' => $type,
            'value' => $value,
        );

        return $ret;
    }
}
