<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
//define conn api db
class API{
    //set props
    private $pdo ;
    private $db = "phpdasar";
    private function __construct()
    {
        //set PDO 
        $host = "localhost";
        $dbName = $this->db;
        $usernameDB = "user";
        $pass = "";
        $charsetAttr = "utf8mb4";
        $dsn  = "mysql:host=$host;dbname=$dbName;charset=$charsetAttr";
        $optionsATTR = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        //set init conn which refers to this->pdo as main 
        try{
            $this->pdo = new PDO($dsn, $usernameDB, $pass, $optionsATTR);
            if(!$this->pdo){
                throw new Exception("error pd init conn pdo");
            }
        }catch(Exception $e){
            print "error: ".$e->getMessage().$e->getFile() ;
        }
    }
}
?>