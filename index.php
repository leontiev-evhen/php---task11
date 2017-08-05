<?php
require_once 'config.php';
spl_autoload_register(function ($class_name) {
    require_once 'libs/'.$class_name . '.php';
});

try
{

    /*============ distinct ===================*/
    $distinct = (new Sql())
        ->distinct()
        ->select(['data'])
        ->from('MY_TEST')
        ->execute();

    /*============ inner join ===================*/
    $innerJoin = (new Sql())
        ->select(['MY_TEST.data'])
        ->from('MY_TEST')
        ->join('inner', 'MY_TABLE', 'MY_TABLE.key = MY_TEST.key')
        ->execute();

    /*============ left join ===================*/
    $leftJoin = (new Sql())
        ->select(['MY_TEST.data'])
        ->from('MY_TEST')
        ->join('left', 'MY_TABLE', 'MY_TABLE.key = MY_TEST.key')
        ->execute();

    /*============ right join ===================*/
    $rightJoin = (new Sql())
        ->select(['MY_TEST.data'])
        ->from('MY_TEST')
        ->join('right', 'MY_TABLE', 'MY_TABLE.key = MY_TEST.key')
        ->execute();

    /*============ cross join ===================*/
    $crossJoin = (new Sql())
        ->select(['MY_TEST.data'])
        ->from('MY_TEST')
        ->join('cross', 'MY_TABLE')
        ->execute();

    /*============ natural join ===================*/
    $naturalJoin = (new Sql())
        ->select(['MY_TEST.data'])
        ->from('MY_TEST')
        ->join('natural', 'MY_TABLE')
        ->execute();

    /*============ group by ===================*/
    $groupBy = (new Sql())
        ->select(['data'])
        ->from('MY_TEST')
        ->groupBy('data')
        ->execute();

    /*============ having ===================*/
    $having = (new Sql())
        ->select(['data'])
        ->from('MY_TEST')
        ->groupBy('data')
        ->having('MIN(data) < 11')
        ->execute();

    /*============ order ===================*/
    $orderBy = (new Sql())
        ->select(['data'])
        ->from('MY_TEST')
        ->orderBy('data', 'desc')
        ->execute();

    /*============ limit ===================*/
    $limit = (new Sql())
        ->select(['data'])
        ->from('MY_TEST')
        ->limit(2)
        ->execute();


}
catch (Exception $e)
{
    echo $e->getMessage();
}

require_once 'templates/index.php';

?>
