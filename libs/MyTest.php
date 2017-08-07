<?php

/**
 * User: yevhen
 * Date: 06.08.17
 * Time: 7:46
 */
class MyTest extends ActiveRecord
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public static function tableName ()
    {
        return 'MY_TEST';
    }


}