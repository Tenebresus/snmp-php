<?php

namespace Tenebresus\Snmp;

use Tenebresus\Snmp\Message;
use Tenebresus\Snmp\PDU\PDU;
use Tenebresus\Snmp\PDU\VarBindList;
use Tenebresus\Snmp\PDU\VarBind;

class BER {

    private int $_byteCounter = 0;
    private array $_BERSequences = [];

    // TODO: AUTOMATE EVERTHING IN THIS CLASSSSSSS

    public function __construct(Message $message) {

        $this->_encodePDU($message->getPDU());

        $this->_BERSequences[] = ["04", "06", "70", "75", "62", "6C", "69", "63"];
        $this->_BERSequences[] = ["02", "01", "01"];
        $this->_byteCounter += 11;

        $this->_BERSequences[] = [$message->getASNHexValue(), dechex($this->_byteCounter)];
        $this->_byteCounter += 2;

    }

    private function _encodePDU(PDU $pdu) : void {

        $this->_encodeVarBindList($pdu->getVarBindList());

        // TODO: automate the shit out of this
        $this->_BERSequences[] = ["02", "01", "00"];
        $this->_BERSequences[] = ["02", "01", "00"];
        $this->_BERSequences[] = ["02", "01", "7b"];
        $this->_byteCounter += 9;

        $this->_BERSequences[] = [$pdu->getASNHexValue(), dechex($this->_byteCounter)];
        $this->_byteCounter += 2;

    }

    private function _encodeVarBindList(VarBindList $varBindList) : void {

        foreach ($varBindList->getVarBinds() as $varBind) {

            $this->_encodeVarBind($varBind);

        }

        var_dump('VarbindList counter: ' . $this->_byteCounter );

        $this->_BERSequences[] = [$varBindList->getASNHexValue(), dechex($this->_byteCounter)];
        $this->_byteCounter += 2;

    }

    private function _encodeVarBind(VarBind $varBind) : void {

        $encodedValue = ["05", "00"];
        $encodedOID = $this->_encodeOID($varBind->getName());

        $this->_BERSequences[] = $encodedValue;
        $this->_BERSequences[] = $encodedOID;

        $this->_byteCounter += (count($encodedValue) + count($encodedOID));

        var_dump('VarBind counter: ' . $this->_byteCounter );

        $this->_BERSequences[] = [$varBind->getASNHexValue(), dechex($this->_byteCounter)];
        $this->_byteCounter += 2;

    }

    private function _encodeOID(string $OID) : array {

        $components = explode('.', $OID);

        $firstComponent = (int) $components[0];
        $secondComponent = (int) $components[1];

        $firstByte = dechex((40 * $firstComponent) + $secondComponent);
        $bytes = [];
        $bytes[] = $firstByte;

        for ($i = 2; $i < count($components); $i++) {

            $bytes[] = dechex((int) $components[$i]);

        }

        return array_merge(["06", dechex(count($bytes))], $bytes);

    }

    public function toString() : string {

        $reversed = array_reverse($this->_BERSequences);

        var_dump($reversed);

        $returnString = '';

        foreach ($reversed as $line) {

            foreach ($line as $item) {

                if (strlen($item) === 1) {
                    $item = "0" . $item;
                }

                $returnString .= $item;
            }

        }
        return $returnString;
    }

}