<?php

/**
 * User: yevhen
 * Date: 06.08.17
 * Time: 9:59
 */
class Database
{
    public static function load ($typeDb)
    {
        if (class_exists($typeDb))
        {
            $class = new $typeDb();
            return $class;
        }
        else
        {
            throw new Exception('Class does not exist');
        }
    }

}