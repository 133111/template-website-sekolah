<?php
//define main class of config : 
class adminManage{ 
    //set props
    private $pdo ; // main pdo executors
    private $tabel = "users"; // tabel dst

    //set methods
    public function __construct(){
        //set data source
        $host = "localhost";
        $usn = "root";
        $pass = "";
        $dbname = "phpdasar";
        $charset = "utf8mb4";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        //options
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //default fetch result
            PDO::ATTR_EMULATE_PREPARES   => false,  
        ];
        try{
            $this->pdo = new PDO($dsn, $usn, $pass, $options);
            if($this->pdo){}; //success
        }catch(\PDOException $e)//hint to PDOException by $e
        {
            throw new PDOException("you have error: " . $e->getMessage() . $e->getCode());
        }
    }
    // define crud funtion section  :
    public function showAll(){
        try{
            $this->pdo->query("SELECT * FROM users");
            return $this->pdo->query("SELECT * FROM $this->tabel")->fetchAll();
        }catch(\PDOException $e){
            throw new PDOException("you have error: " . $e->getMessage() . $e->getCode()); //return if error n error
        }
    }
    public function newAdmin(){
        try{
            $this->pdo->beginTransaction();
            $this->pdo->prepare(""); //set template
        }catch(\PDOException){
            //soon
        }
    }
}
$exec = new adminManage();
$allData = $exec->showAll();
?>