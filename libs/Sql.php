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

    public function select ($fields)
    {
        if ($this->checkArray($fields))
        {
            if (in_array("*", $fields))
            {
                throw new Exception('Forbidden character');
            }

            $this->select = 'SELECT '.(!empty($this->distinct) ? $this->distinct : '').implode(', ', $fields).' FROM ';
            return $this;
        }
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

    public function from ($table, $alias = ' ')
    {
       $this->from = $table.$alias;
       return $this;
    }

    public function where ($condition)
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

    public function distinct ()
    {
        $this->distinct = 'DISTINCT ';
        return $this;
    }

    public function join ($type, $table, $on = '')
    {
       $this->join = ' '.strtoupper($type).' JOIN '.$table.(!empty($on) ? ' ON '.$on : '');
       return $this;
    }

    public function groupBy ($field)
    {
        $this->groupBy = ' GROUP BY '.$field;
        return $this;
    }

    public function having ($arg) {
         $this->having = ' HAVING '.$arg;
         return $this;
    }

    public function orderBy ($field, $sort = 'ASC')
    {
        $this->orderBy = ' ORDER BY '.$field.' '.strtoupper($sort);
        return $this;
    }

    public function limit ($num, $offset = '')
    {
        $this->limit = ' LIMIT '.$num.(!empty($offset) ? ','.$offset : '');
        return $this;
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

    public function execute()
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
