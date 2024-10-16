<?php

namespace Tenebresus\Snmp\PDU;

class VarBind {

    private string $_name;
    private ?string $_value;

    private const string _ASN_HEX_VALUE = "30";

    public function __construct(string $name, ?string $value) {
        $this->_name = $name;
        $this->_value = $value;
    }

    public function setName(string $name) : void {
        $this->_name = $name;
    }

    public function getName() : string {
        return $this->_name;
    }

    public function setValue(string $value) : void {
        $this->_value = $value;
    }

    public function getValue() : string {
        return $this->_value;
    }

    public function getASNHexValue() : string {
        return self::_ASN_HEX_VALUE;
    }

}