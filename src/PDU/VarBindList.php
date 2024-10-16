<?php

namespace Tenebresus\Snmp\PDU;

use Tenebresus\Snmp\PDU\VarBind;

class VarBindList {

    private const string _ASN_HEX_VALUE = "30";

    public function getASNHexValue() : string {
        return self::_ASN_HEX_VALUE;
    }

    private array $_varBinds = [];

    public function addVarBind(VarBind $varBind) {
        $this->_varBinds[] = $varBind;
    }

    /**
     * @return VarBind[] returns an array of VarBinds
     */
    public function getVarBinds() : array {
        return $this->_varBinds;
    }

}