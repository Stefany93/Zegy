<?php
         use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\FirePHPHandler;
 // Create the logger
$logger = new Logger('error_log');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/log/error_log.log', Logger::ERROR));
$logger->pushHandler(new FirePHPHandler()); 