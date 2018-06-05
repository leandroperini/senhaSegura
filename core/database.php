<?php

class Database {

    public  $connection = 'default';
    private $db_conf    = [
        'default' => [
            'host' => '192.168.10.1',
            'user' => 'root',
            'pass' => 'root',
            'db'   => 'senha_segura',
        ],
    ];


    function execute($sql = null, array $params = [], $connectionConf = '') {
        $return    = false;
        $types     = '';
        $bindParam = [];
        try {
            $connectionConf = $connectionConf ?: $this->connection;
            $connection     = new mysqli($this->db_conf[$connectionConf]['host'], $this->db_conf[$connectionConf]['user'], $this->db_conf[$connectionConf]['pass'], $this->db_conf[$connectionConf]['db']);

            $stmt = $connection->prepare($sql);
            if (is_bool($stmt)) {
                throw new \Exception('Erro ao montar query e seus parâmetros.');
            }
            if (!empty(@$params['types']) && !empty(@$params['values'])) {
                foreach (@$params['types'] as $type) {
                    $types .= $type;
                }

                array_push($bindParam, $types);

                foreach (@$params['values'] as &$value) {
                    array_push($bindParam, $value);
                }

                call_user_func_array([$stmt, 'bind_param'], $this->refValues($bindParam));
            }
            $stmt->execute();
            $result = NULL;
            $result = $stmt->get_result();
            if ($result !== FALSE && $result !== TRUE) {
                $return = $result->fetch_all(MYSQLI_ASSOC);
                if (count($return) == 1 && is_array($return)) {
                    $return = reset($return);
                }
            } else {
                $return = $stmt->error . ' - ' . $connection->info;
            }
        } catch (Exception $exc) {
            throw $exc;
        } finally {
            $connection->close();
            return $return;
        }
    }

    private function refValues($arr) {
        $refs = array();
        foreach ($arr as $key => $value) $refs[$key] = &$arr[$key];
        return $refs;
    }

    public function connection($value) {
        $this->connection = $value;
        return $this;
    }

}
