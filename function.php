<?php
/**
 * User: yevhen
 * Date: 08.08.17
 * Time: 9:35
 */

function myAutoload($class_name){
    $file = __DIR__.'/libs/' . $class_name . '.php';
    if (file_exists($file))
    {
        require_once $file;
    }
    else
    {
        throw new Exception('Class does not exist');
    }
}