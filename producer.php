<?php
require './vendor/autoload.php';
date_default_timezone_set('PRC');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create the logger
$logger = new Logger('my_logger');
$logger->pushHandler(new StreamHandler(fopen('php://stdout', 'w')));

$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('localhost:9192');
// $config->setBrokerVersion('0.9.0.1');
$config->setBrokerVersion('1.0.0');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);
$producer = new \Kafka\Producer();
// $producer->setLogger($logger);

$msg = 'Message from test: ' . mt_rand(0, 1000);

$result = $producer->send(array(
    array(
        'topic' => 'test',
        'value' => $msg,
        'key' => '',
    ),
));
var_dump($msg);
// var_dump($result);