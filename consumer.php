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
$config->setMetadataBrokerList('127.0.0.1:9192');
$config->setGroupId('test');
$config->setBrokerVersion('0.9.0.1');
$config->setTopics(array('test'));
//$config->setOffsetReset('earliest');
$consumer = new \Kafka\Consumer();
$consumer->setLogger($logger);
$consumer->start(function($topic, $part, $message) {
	var_dump($message);
});