<?php

namespace Tenebresus\Snmp;

use Tenebresus\Snmp\PDU\PDU;
use Tenebresus\Snmp\BER;

class Message {

    private const string _ASN_HEX_VALUE = "30";
    private int $_version;
    private string $_community;

    private ?PDU $_PDU = NULL;

    /**
     * @param int $version
     * @param string $community
     * @param PDU|null $PDU
     */
    public function __construct(int $version, string $community, ?PDU $PDU = NULL) {

        $this->_version = $version;
        $this->_community = $community;

        if ($PDU !== NULL) {
            $this->_PDU = $PDU;
        }

    }

    /**
     * @param PDU $PDU
     * @return void
     */
    public function setPDU(PDU $PDU) : void {
        $this->_PDU = $PDU;
    }

    /**
     * @return PDU|null Returns NULL if the PDU property has not been set before
     */

    public function getPDU() : ?PDU {

        if ($this->_PDU !== NULL) {
            return $this->_PDU;
        }

        return NULL;

    }

    public function encode() : BER {
        return new BER($this);
    }

    public function getASNHexValue() : string {
        return self::_ASN_HEX_VALUE;
    }

}