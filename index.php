<?php
require_once 'config.php';
require_once 'function.php';

try
{
    spl_autoload_register(function ($class_name) {
        myAutoload($class_name);
    });

    $class = new MyTest();
    $class->find(['key' => 'user11']);
    $class->key = 'user11';
    $class->data = 'test6';
    $result = $class->save();
}
catch (Exception $e)
{
    $error = $e->getMessage();
}

require_once 'templates/index.php';

?>
