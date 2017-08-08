<?php

/**
 * User: yevhen
 * Date: 06.08.17
 * Time: 12:25
 */
class MySql extends Sql
{
    private $db;
    private $mSelect = false;

    public function __construct ()
    {
        if (!$this->db = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new Exception('Mysql database error');
        }
    }

    public function select ($fields = '')
    {
        $this->mSelect = true;
        return parent::select($fields);
    }

    public function from ($table)
    {
        return parent::from($this->quoteSimpleTableName($table));
    }

    public function insert ()
    {
        return parent::insert();
    }

    public function update ()
    {
        return parent::update();
    }

    public function delete ()
    {
        return parent::delete();
    }

    public function values ($set)
    {
        $aSet = $this->quoteSimpleColumnsName($set);
        return parent::values($aSet);
    }

    public function where ($condition)
    {
        $aCondition = $this->quoteSimpleColumnsName($condition);
        return parent::where($aCondition);
    }

    public function set ($fields)
    {
        $aFields = $this->quoteSimpleColumnsName($fields);
        return parent::set($aFields);
    }

    public function getColumsName ($table)
    {
        $sql = parent::getColumsName($this->quoteSimpleTableName($table));
        if ($result = $this->db->query($sql))
        {

            foreach ($result as $row) {
                $rows[$row['Field']] = '';
            }
            return $rows;
        }
        else
        {
            throw new Exception('Error,cannot get column name');
        }
    }

    private function quoteSimpleTableName ($name)
    {
        return strpos($name, '`') !== false ? $name : '`' . $name . '`';
    }

    private function quoteSimpleColumnsName ($fields)
    {
        if ($this->checkArray($fields))
        {
            $aFields = [];
            foreach ($fields as $key=>$field)
            {
                $key = strpos($key, "`") !== false ? $key : "`" . $key . "`";
                $aFields[$key] = $field;
            }
            return $aFields;
        }

    }

    public function execute()
    {
        $sql = parent::execute();

        $result = $this->db->prepare($sql);
        if (!$result->execute())
        {
            throw new Exception('Mysql query error');
        }
        else
        {
            if ($this->mSelect)
            {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                return SUCCESS_MESSAGE;
            }

        }
    }
}