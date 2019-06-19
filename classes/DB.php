<?php

class DB {

    private static $instance = null;
    private $connection;
    private $config;
    private $query;
    private $error = false;
    private $results;
    private $count = 0;

    private function __construct(){

        $this->config = Config::get('database');

        $driver = $this->config['driver'];
        $db_name = $this->config[$driver]['db'];
        $host = $this->config[$driver]['host'];
        $user = $this->config[$driver]['user'];
        $pass = $this->config[$driver]['pass'];
        $charset = $this->config[$driver]['charset'];
        $dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";

        try {
            $this->connection = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die($e->getMessage());
        }        
    }

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

    public function query($sql, $params = array()){
        $this->error = false;

        if($this->query = $this->connection->prepare($sql)){

            if (!empty($params)) {
                $counter = 1;
                foreach ($params as $param) {
                    $this->query->bindValue($counter, $param);
                    $counter++;
                }
            }

            if ($this->query->execute()) {
                $this->results = $this->query->fetchAll(Config::get('database')['fetch']);
                $this->count = $this->query->rowCount();
            }else{             
                $this->error = true;
                die($this->query->errorInfo()[2]);
            }        
        }
        return $this;
    }

    public function action($action, $table, $where = array()){
        if (count($where) === 3) {
            
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            $sql = "$action FROM $table WHERE $field $operator ?";

            if(!$this->query($sql, array($value))->getError()){
                return $this;
            }

        } else {
            $sql = "$action FROM $table";

            if(!$this->query($sql)->getError()){
                return $this;
            }
        }
        return false;
    }

    public function get($columns, $table, $where = array()){
        return $this->action("SELECT $columns", $table, $where);
    }

    public function delete($table, $where = array()){
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $columns){

        $keys = implode(",", array_keys($columns));
        $field_num = count($columns);
        $values = '';
        $counter = 1;

        foreach ($columns as $key => $value) {

            if (is_string($value)) {
                $value = "'$value'";
            }

            $values .= $value;
            if ($counter < $field_num) {
                $values .= ',';
            }
            $counter++;
        }

        $sql = "INSERT INTO $table ($keys) VALUES ($values)";

        if(!$this->query($sql, $columns)->getError()){
            return $this;
        }

        return false;
    }

    

    public function update($table, $fields, $id){

        $field_num = count($fields);
        $values = '';
        $counter = 1;

        foreach ($fields as $key => $value) {

            if (is_string($value)) {
                $value = "'$value'";
            }

            $values .= "$key = $value";
            if ($counter < $field_num) {
                $values .= ',';
            }
            $counter++;
        }

        $sql = "UPDATE $table SET $values WHERE id=$id";

     
    }

    public function getError(){
        return $this->error;
    }
}