<?php
require './vendor/autoload.php';
date_default_timezone_set('PRC');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(fopen('php://stdout', 'w')));

$config = \Kafka\ConsumerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('localhost:9192');
$config->setGroupId('test');
// $config->setBrokerVersion('0.9.0.1');
$config->setBrokerVersion('1.0.0');
$config->setTopics(array('test'));
$config->setOffsetReset('earliest');
// $config->setOffsetReset('latest');
$consumer = new \Kafka\Consumer();
// $consumer->setLogger($logger);
$consumer->start(function($topic, $part, $message) {
    echo "\n";
    var_dump($message);
    echo "\n";
});