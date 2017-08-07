<?php
require_once 'config.php';
spl_autoload_register(function ($class_name) {
    require_once 'libs/'.$class_name . '.php';
});

try
{
    $class = new MyTest();
    $class->key = 'user11';
    $class->data = 'test';
    $result = $class->save();
}
catch (Exception $e)
{
    $error = $e->getMessage();
}

require_once 'templates/index.php';

?>
