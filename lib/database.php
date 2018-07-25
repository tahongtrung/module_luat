<?php
    class Database{
        private $_sql;
        protected $conn;
        
        public function database(){}
        public function connect(){
            error_reporting(E_ALL ^ E_DEPRECATED);
            global $database;
            global $password;
            global $server;
            global $username;
            $this->conn = mysql_connect($server,$username,$password);
            
            if($this->conn){
                if(!mysql_select_db($database)){
                    echo "cannot connect to database $database";
                    die;
                }
            }else{
                echo "cannot connect to server $server";
                die;
            }
        }
        public function disconnect(){
            $this->conn = null;
        }
        public function setQuery($sql){
            $this->_sql = $sql;
        }
        public function executeQuery($sql){
            $out = new ArrayObject();
            $this->connect();
            $this->setQuery($sql);
            $rs = mysql_query($this->_sql);
            while( $row = mysql_fetch_object($rs)){
                $out->append($row);
            }
            $this->disconnect();
            return $out;
            
        } 
        public function executeNonQuery($sql){
            $this->connect();
            $this->setQuery($sql);
            mysql_query($this->_sql);
            $this->disconnect();
        }
        
    }
   