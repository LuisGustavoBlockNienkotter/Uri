<?php 

require_once "autoload.php";

class Conexao
{
	
	private $pdo;


    /**
     * Class Constructor
     * @param    $pdo   
     */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=BancoURI', "root","");
    }


    /**
     * @return mixed
     */
    public function getPdo()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=BancoURI', "root","");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     *
     * @return self
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}


 ?>