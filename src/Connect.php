<?php

namespace Tenebresus\Snmp;

class Connect {

    private mixed $_connection;

    private string $_ip;
    private string $_port;

    public function __construct(string $ip, int $port) {

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        if (!$sock) {
            var_dump('ERROR CREATING SOCKET!');
            return;
        }

        if (!socket_connect($sock, $ip, $port)) {
            var_dump('ERROR CONNECTING TO SOCKET');
            return;
        }
        $this->_connection = $sock;

        $this->_ip = $ip;
        $this->_port = $port;

        var_dump('started connection');

    }

    public function sendMessage(string $message) : void {

        var_dump('before write');

        var_dump($message);

        if (!socket_send($this->_connection, $message, strlen($message), 0)) {
            var_dump('ERROR SENDING MESSAGE!');
            return;
        }

        var_dump('after write');

        $return = '';

        var_dump('before recv');

        if (!socket_recvfrom($this->_connection, $return, 1024, 0, $this->_ip, $this->_port)) {
            var_dump('ERROR RECEIVING DATA!');
            return;
        }

        var_dump('after recv');

        var_dump($return);


    }

}