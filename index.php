<?php
require_once 'config.php';
require_once 'function.php';

try
{
    spl_autoload_register(function ($class_name) {
        myAutoload($class_name);
    });

    $class = new MyTest();

    /*============= select =====================*/
    $result = $class->find(['key' => 'user11']);

    /*============= insert =====================*/

   // $class->key = 'user11';
   // $class->data = 'test';
   // $result = $class->save();

    /*============= update =====================*/
   // $class->find(['key' => 'user11']);
   // $class->key = 'user11-2';
   // $class->data = 'test2';
   // $result = $class->save();

    /*============= delete =====================*/
   // $class->find(['key' => 'user11']);
   // $result = $class->delete();
}
catch (Exception $e)
{
    $error = $e->getMessage();
}

require_once 'templates/index.php';

?>
