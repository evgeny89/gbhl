<?php
require_once('vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;

// соединяемся с RabbitMQ
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

// Создаем канал общения с очередью
$channel = $connection->channel();

$channel->queue_declare('Drink', false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('Drink', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    try {
        $channel->wait();
    } catch (ErrorException $e) {
        echo $e->getMessage();
    }
}