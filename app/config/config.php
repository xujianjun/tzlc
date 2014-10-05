<?php

return new \Phalcon\Config(array(
    'database'    => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'touzilicai',
        'charset'  => 'utf8'
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'baseUri'        => '/',
        'debug'          => false
    ),
));
