<?php
    class DataBase{
        private static string $server = "localhost";
        private static string $login = "useredu-medvedev";
        private static string $password = ")7Rb@gQ@U@]FWCE";
        private static string $database = "dbedu-medvedev";
        static $instance = null;
        private $mysqli;

        private function __construct (){
            $this->mysqli = mysqli_connect(static::$server, static::$login, static::$password,static::$database);
        }

        private function __destruct()
        {
            if($this->mysqli){
                $this->mysqli->close();
            }
        }

        public static function getInstance(){
            if(static::$instance){
                return static::$instance;
            }
            static::$instance = new static();
            return static::$instance;
        }

        public function getSelectRequest($request){
            $sql = $this->mysqli->query($request);
            return $sql;
        }

        public function getSelectRequestPrepare($requestStringSql, $stringS, $arrayWhatSearch){
            $sql = $this->mysqli->prepare($requestStringSql);
            $sql = $this->whileForOperationInsertUpdateSelect($sql,$arrayWhatSearch,$stringS);
            $sql->execute();
            return $sql->get_result();
        }

        public function getInsertRequestPrepare($requestStringSql, $stringS, $arrayWhatSearch){
            $sql = $this->mysqli->prepare($requestStringSql);
            $sql = $this->whileForOperationInsertUpdateSelect($sql,$arrayWhatSearch,$stringS);
            $sql->execute();
        }

        private function whileForOperationInsertUpdateSelect($sql,$arrayWhatSearch,$stringS){
            call_user_func_array([$sql, 'bind_param'], array_values(array_merge([$stringS], $arrayWhatSearch)));
            return $sql;
        }
    }