<?php

use Bread\Configuration\Manager as Configuration;
use Bread\Networking\HTTP\Server;
use Bread\REST\Routing\Dispatcher;

$loader = require_once implode(DIRECTORY_SEPARATOR, array(
    dirname(__DIR__),
    'vendor',
    'autoload.php'
));

$configuration = implode(DIRECTORY_SEPARATOR, array(
    'file:/',
    dirname(__DIR__),
    'configuration'
));

return Configuration::initialize($configuration)->then(function ($configuration) {
    return Server::factory(PHP_SAPI)->on('request', array(
        new Dispatcher(),
        'dispatch'
    ))->listen(8000)->run();
});
