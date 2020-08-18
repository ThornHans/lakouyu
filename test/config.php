<?php

class DB
{ 
   public $servername = "localhost";
   public $username = "la";
   public $password = "fdspfdsp";
   public $dbname = "la";
   public $conn;
  
   public function __construct(){ 

    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } 


function insert($keys, $vals, $table){
    echo 'hahaha';
   
    $keys = $keys;
    $vals = $vals;
    $keystr = "INSERT INTO ".$table." (";
    $valstr = " VALUES (";
    for ($i=0; $i < count($keys) ; $i++) { 
        $keystr .= $keys[$i].',';
        $valstr .= ':'.$keys[$i].',';

    }

    $keystr = rtrim($keystr, ",");
    $valstr = rtrim($valstr, ",");

    $keystr .= ')';
    $valstr .= ')';
    $str = $keystr.$valstr;


    $stmt = $this->conn->prepare($str);
    for ($i=0; $i < count($keys) ; $i++) { 
         $keyname = $keys[$i];
         $stmt->bindParam(':'.$keys[$i], $$keyname);

    }
       for ($i=0; $i < count($keys) ; $i++) { 
         $keyname = $keys[$i];
         $$keyname = $vals[$i];
    }
    
    $stmt->execute();
    }

    function select($table, $keys, $conkeys, $convals){
        
        $consql = 'WHERE ';
        $bindsql = [];
        foreach ($keys as $key) {
            $fields .= $key.',';
        }
        $fields = rtrim($fields,',');
       
        for ($i=0; $i < count($conkeys); $i++) { 
            $consql .= $conkeys[$i].' = ? and ';
           
        }
        $consql = rtrim($consql,' and');
        $sql = "SELECT ".$fields." FROM ".$table." ".$consql;
        $stmt = $this->conn->prepare($sql); 

        foreach ($convals as $cv) {
            array_push($bindsql, $cv);

        }
       
        if(!$stmt->execute($bindsql)) throw new Exception('Stmt Failed');



        
        $row = $stmt->fetchAll();

        return $row;

    
    }


 
}

?>