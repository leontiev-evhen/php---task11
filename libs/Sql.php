<?php 


class Sql
{
    protected $query;
    protected $select;
    protected $insert;
    protected $update;
    protected $delete;
    protected $from;
    protected $values;
    protected $set;
    protected $distinct;
    protected $join;
    protected $where;
    protected $groupBy;
    protected $having;
    protected $orderBy;
    protected $limit;

    protected function select ($fields = '')
    {
        if (empty($fields))
        {
            $fields = '*';
        }
        else
        {
            if ($this->checkArray($fields))
            {
                $fields = implode(', ', $fields);
            }
        }

        $this->select = 'SELECT '.(!empty($this->distinct) ? $this->distinct : '').$fields.' FROM ';
        return $this;

    }

    protected function insert ()
    {
        $this->insert = 'INSERT INTO ';
        return $this;
    }

    protected function update ()
    {
        $this->update = 'UPDATE ';
        return $this;
    }

    protected function delete ()
    {
        $this->delete = 'DELETE FROM ';
        return $this;
    }

    protected function from ($table)
    {
       $this->from = $table;
       return $this;
    }

    protected function where ($condition)
    {
        $this->where = ' WHERE '.key($condition).' = '."'".$condition[key($condition)]."'";
        return $this;
    }

    protected function set ($fields)
    {
        if ($this->checkArray($fields))
        {
            foreach($fields as $key=>$val) {
                $arr[] = $key.' = '."'".$val."'";
            }

            $this->set = ' SET '.implode(' , ', $arr);
            return $this;
        }
    }

    protected function values ($set)
    {
        if ($this->checkArray($set))
        {
            foreach ($set as $key=>$value) {
                $aSet[$key] = $this->quoteSimpleColumnName($value);
            }

            $key    = array_keys($aSet);
            $values = array_values($aSet);
            $this->values = ' ('.implode(', ', $key).') VALUES ('.implode(', ', $values).')';
            return $this;
        }
    }

    protected function distinct ()
    {
        $this->distinct = 'DISTINCT ';
        return $this;
    }

    protected function join ($type, $table, $on = '')
    {
       $this->join = ' '.strtoupper($type).' JOIN '.$table.(!empty($on) ? ' ON '.$on : '');
       return $this;
    }

    protected function groupBy ($field)
    {
        $this->groupBy = ' GROUP BY '.$field;
        return $this;
    }

    protected function having ($arg) {
         $this->having = ' HAVING '.$arg;
         return $this;
    }

    protected function orderBy ($field, $sort = 'ASC')
    {
        $this->orderBy = ' ORDER BY '.$field.' '.strtoupper($sort);
        return $this;
    }

    protected function limit ($num, $offset = '')
    {
        $this->limit = ' LIMIT '.$num.(!empty($offset) ? ','.$offset : '');
        return $this;
    }

    protected function getColumsName ($table)
    {
        return 'SHOW COLUMNS FROM '.$table;
    }

    protected function checkArray ($array)
    {
        if (is_array($array)) {
            return true;
        }
        else
        {
            throw new Exception('argument is not array');
        }
    }

    protected function quoteSimpleColumnName ($name)
    {
        return strpos($name, "'") !== false ? $name : "'" . $name . "'";
    }

    protected function execute()
    {
        switch ($this)
        {
            case !empty($this->insert):
                return $this->insert.$this->from.$this->values;

            case !empty($this->select):
                return $this->select.$this->from.$this->values.$this->join.$this->where.$this->groupBy.$this->having.$this->orderBy.$this->limit;

            case !empty($this->update):
                return $this->update.$this->from.$this->set.$this->where;

            case !empty($this->delete):
                return $this->delete.$this->from.$this->where;
        }
    }

}
?>
