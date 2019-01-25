<?php

  /**
   * Database PDO Class
   * Create Prepared Statements
   * Bind Values & Params
   * Execute Queries
   * Retrun Rows From Database
   */

  class Database {
    private $db_user = DB_USER;
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_pass = DB_PASS;
    private $con;
    private $stmt;
    private $error;

    // Constructor
    public function __construct(){
      $dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name;
      $pdo_options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ];
      try {
        $this->con = new PDO($dsn, $this->db_user, $this->db_pass, $pdo_options);
      } catch (PDOException $e) {
        $this->error = 'Failed To Connect'.$e->getMessage();
        echo $this->error;
      }
    }

    // Query Method
    public function query($sql){
      $this->stmt = $this->con->prepare($sql);
    }

    // Bind Values
    public function bindValues($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_null($type):
            $type = PDO::PARAM_NULL;
            break;
          case is_int($type):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($type):
            $type = PDO::PARAM_BOOL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
      }
    }
    
    // Execute Method
    public function execute(){
      return $this->stmt->execute();
    }

    // Single Row
    public function single(){
      $this->stmt->execute();
      return $this->stmt->fetch();
    }

    // Multi Rows
    public function multi(){
      $this->stmt->execute();
      return $this->stmt->fetchAll();
    }

    // Get Row Count
    public function rowCount(){
      $this->stmt->execute();
      $rowCount = $this->stmt->rowCount();
      return $rowCount;
    }
  }
  