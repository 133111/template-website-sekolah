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
        }catch(\PDOException $e)//hint to PDOException, refer -> $e
        {
            throw new PDOException("you have error: " . $e->getMessage() . $e->getCode());
        }
    }
    // define CRUD function section  :
    public function showAll(){ //S
        try{
            $this->pdo->query("SELECT * FROM users");
            return $this->pdo->query("SELECT * FROM $this->tabel")->fetchAll();
        }catch(\PDOException $e){
            throw new PDOException("you have error: " . $e->getMessage() . $e->getCode()); //return if error n error
        }
    }
    public function newAdmin($name, $email, $pass){ //C
        try{
            $this->pdo->beginTransaction();
            $this->pdo->prepare("INSERT INTO $this->tabel (nama, email, pass) VALUES (?, ?, ?)"); //set template
            //get data n filter
            $nameAdmin = $name; 
            $emailAdmin = $email;
            $passAdmin = $pass;
        }catch(\PDOException $e){
            $this->pdo->rollback();
            throw new PDOException("error:". $e->getMessage().$e->getCode());
        }
    }
}
$exec = new adminManage();
$allData = $exec->showAll(); //get All for table
?>