<?php
class Database {
    // Params

     // Localhost settings
        private $host = 'localhost';
        private $db_name = 'moment5';
        private $username = 'moment5';
        private $password = 'password';
   

    // Connect to DB
    public function connect() {
        $this->conn = null;

        try {
          $this->conn = new PDO('mysql:host=' . $this->host . ';db_name=' . $this->db_name,
          $this->username, $this->password, 
          array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    // public function close() {
    //     $this->conn = null;
    // }
}