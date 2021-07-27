<?php
require_once('vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
//use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;

try {
    // соединяемся с RabbitMQ
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    // Создаем канал общения с очередью
    $channel = $connection->channel();

    $channel->queue_declare('Drink', false, true, false, false);

    // создаем сообщение
    //$msg = new AMQPMessage($_POST['type']);
    $msg = new AMQPMessage("test-drink");
    // размещаем сообщение в очереди
    $channel->basic_publish($msg, '', 'Drink');

    // закрываем соединения
    $channel->close();
    $connection->close();
}
catch (Exception $e) {
    echo $e->getMessage();
}

