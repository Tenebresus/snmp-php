<?php

namespace Tenebresus\Snmp\PDU;

use Tenebresus\Snmp\PDU\VarBindList;

class PDU {

    private const string _ASN_HEX_VALUE = "A0";
    private int $_requestID;
    private int $_errorStatus = 0;
    private int $_errorIndex = 0;
    private VarBindList $_varBindList;

    public function __construct(string $objectName, ?string $objectValue = NULL, int $requestID = 12345) {

        $this->_varBindList = new VarBindList();
        $this->_varBindList->addVarBind(new VarBind($objectName, $objectValue));
        $this->_requestID = $requestID;

    }

    public function getVarBindList() : VarBindList {
        return $this->_varBindList;
    }

    public function getASNHexValue() : string {
        return self::_ASN_HEX_VALUE;
    }
}