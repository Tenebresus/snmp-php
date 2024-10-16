<?php

require 'vendor/autoload.php';

use Tenebresus\Snmp\Message;
use Tenebresus\Snmp\PDU\PDU;
use Tenebresus\Snmp\Connect;

$message = new Message(2, 'public');

// TODO: FIX MULTIPLY PDU TYPES, NOW THERE IS ONLY GETREQUEST BUT WE WANT GETNEXTREQUEST

$pdu = new PDU('1.3.6.1.2.1.25.2.3.1.3.8');
$message->setPDU($pdu);

var_dump($message->encode()->toString());

$encodedMessage = $message->encode()->toString();

$connect = new Connect('172.19.11.25', 161);
$connect->sendMessage(hex2bin($encodedMessage));
