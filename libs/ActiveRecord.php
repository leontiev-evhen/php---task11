<?php

/**
 * User: yevhen
 * Date: 05.08.17
 * Time: 14:34
 */
class ActiveRecord
{
    private $db;
    private $condition;
    private $arrayFields;
    private $arrayColumns = [];
    
    public function __construct ()
    {
        $this->loadDataBase();
        $this->arrayColumns = $this->getColumsName();
    }

    public function __set ($name, $value)
    {
        $this->arrayColumns[$name] = $value;
    }

    public function __get ($name)
    {
        if (array_key_exists($name, $this->arrayColumns))
        {
            return $this->arrayColumns[$name];
        }
        else
        {
            throw new Exception('Undefined column '.$name);
        }
    }

    public static function tableName (){}

    private function loadDataBase ()
    {
        $this->db = Database::load(TYPE_DB);
    }

    public function save ()
    {
        $this->arrayFields = $this->checkData();
        if (!$this->condition)
        {
            return $this->insert();
        }
        else
        {
            return $this->update();
        }
    }

    public function find ($condition = '')
    {
        if (!empty($condition))
        {
            if ($result = $this->db->select()->from(static::tableName())->where($condition)->execute())
            {
                $this->condition = $condition;
                $this->loadDataBase();
                return $result;
            }
            else
            {
                throw new Exception('FUNCTION FIND(): nothing find');
            }
        }
        else
        {
            throw new Exception('ERROR FUNCTION FIND(): Argument does not be empty');
        }
    }

    public function update ()
    {
        return $this->db->update()->from(static::tableName())->set($this->arrayFields)->where($this->condition)->execute();
    }

    public function insert()
    {
        return $res = $this->db->insert()->from(static::tableName())->values($this->arrayFields)->execute();
    }

    public function delete ()
    {
        return $this->db->delete()->from(static::tableName())->where($this->condition)->execute();
    }

    public function getColumsName ()
    {
        return $this->db->getColumsName(static::tableName());
    }

    private function checkData ()
    {
        $aData = [];
        foreach ($this->arrayColumns as $key=>$item)
        {
            if (!empty($item))
            {
                $aData[$key] = $item;
            }
        }
        return $aData;
    }
}