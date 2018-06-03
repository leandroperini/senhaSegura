<?php



abstract class Model extends Database {
    public $columns    = '';
    public $conditions = [];
    public $table      = '';
    public $order      = '';
    public $join       = [];

    public function __construct() {
        if (empty($this->table)) {
            $this->table = $this->camelToUnderscore(get_class($this));
        }
    }

    private function camelToUnderscore($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    public function columns($value) {
        $this->columns = $value;
        return $this;
    }

    public function conditions(array $value) {
        $this->conditions = $value;
        return $this;
    }

    public function table($value) {
        $this->table = $value;
        return $this;
    }

    public function order($value) {
        $this->order = $value;
        return $this;
    }

    public function join(array $value) {
        $this->join = $value;
        return $this;
    }

    public function get() {
        $params = [];
        $sql    = "select {$this->columns} from {$this->table}";

        $this->parseJoin($sql);
        $params = $this->parseConditions($sql);
        $this->parseOrder($sql);
        $sql .= " ;";

        return $this->execute($sql, $params);
    }

    private function parseJoin(&$sql) {
        if (!empty($this->join) && is_array($this->join)) {
            $sql .= " join ";
            foreach ($this->join as $table => $condition) {
                $sql .= " $table on $condition ";
            }
        }
    }

    private function parseConditions(&$sql) {
        $params = [];
        if (!empty($this->conditions)) {
            $sql .= " where ";
            foreach ($this->conditions as $field => $value) {
                $sql                .= " $field ? ";
                $params['values'][] = $value;
                $type               = $this->paserParam($value);
                $params['types'][]  = $type;
            }
        }
        return $params;
    }

    private function paserParam($param) {
        $type = '';
        switch (true) {
            case is_integer((integer)$param) && is_numeric($param):
                $type = 'i';
                break;
            case is_double((float)$param) && is_numeric($param):
                $type = 'd';
                break;
            case is_string($param):
                $type = 's';
                break;
            default:
                $type = 'b';
                break;
        }
        return $type;
    }

    private function parseOrder(&$sql) {
        if (!empty($this->order)) {
            $sql .= " order by {$this->order} ";
        }
    }

    public function update(array $setValues) {
        $params = [];
        $sql    = "update {$this->table}";
        $this->parseJoin($sql);
        if (!empty($setValues)) {
            $sql .= " set ";
            foreach ($setValues as $field => $value) {
                $sql                .= " $field = ?, ";
                $params['values'][] = $value;
                $type               = $this->paserParam($value);
                $params['types'][]  = $type;
            }
        }
        $sql    = substr($sql, 0, strlen($sql) - 2);
        $params = array_merge_recursive($params, $this->parseConditions($sql));
        $sql    .= " ;";
        return $this->execute($sql, $params);
    }

    public function delete() {
        $params = [];
        $sql    = "delete from {$this->table}";
        $this->parseJoin($sql);
        $params = $this->parseConditions($sql);
        $sql    .= " ;";
        return $this->execute($sql, $params);
    }

    public function insert(array $valuesInsert) {
        $sql       = "insert into {$this->table} ";
        $sqlValues = ' values (';
        $params    = [];
        if (!empty($valuesInsert)) {
            $sql .= " ( ";
            foreach ($valuesInsert as $field => $value) {
                $sql                .= " $field, ";
                $sqlValues          .= " ?, ";
                $params['values'][] = $value;
                $type               = $this->paserParam($value);
                $params['types'][]  = $type;
            }
            $sql       = substr($sql, 0, strlen($sql) - 2) . ') ';
            $sqlValues = substr($sqlValues, 0, strlen($sqlValues) - 2) . ') ';
            $sql       .= " $sqlValues ;";
        }
        return $this->execute($sql, $params);
    }
}