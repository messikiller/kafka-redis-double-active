<?php
require './vendor/autoload.php';
date_default_timezone_set('PRC');
use Monolog\Logger;
use Monolog\Handler\StdoutHandler;
use Monolog\Handler\StreamHandler;
// Create the logger
$logger = new Logger('my_logger');
$logger->pushHandler(new StreamHandler(fopen('php://stdout', 'w')));

$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('127.0.0.1:9192');
$config->setBrokerVersion('0.9.0.1');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);
$producer = new \Kafka\Producer();
$producer->setLogger($logger);

for($i = 0; $i < 3; $i++) {
    $result = $producer->send(array(
        array(
            'topic' => 'test1',
            'value' => 'test1....message.' . $i,
            'key' => '',
        ),
    ));
    var_dump($result);
}