<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('main');
$sh = new StreamHandler('log/my.log', Logger::DEBUG);
$log->pushHandler($sh);

$time_start = microtime();
$mem_before = memory_get_usage();

echo 'Hello World!<br>';

require_once 'route.php';

$page = $route[$_SERVER['REQUEST_URI']] ?? null;

if ($page) {
    require_once $page;
}

$log->info('memory use after include page: '. (memory_get_usage() - $mem_before));
$mem_before = memory_get_usage();

function deep_end( $count ) {
    // добавляем 1 к параметру count
    $count += 1;
    if ( $count < 15 ) {
            deep_end( $count );
    }
    else {
            trigger_error( "going off the deep end!" );
    }
}
deep_end( 1 );


$mem_after = memory_get_usage();

$log->debug('page generate '. round(microtime() - $time_start, 4) .'msec');
$log->info('memory use end script: '. ($mem_after - $mem_before));
