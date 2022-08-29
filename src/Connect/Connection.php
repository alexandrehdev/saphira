<?php
namespace Saphira\Connectdb\Connect;
use PDO;
use PDOException;

class Connection{


	private $con;

	public function setCon($data) :void{
	    $this->con = $data;
	}

	public function getCon() :object{
	    return $this->con;
	}


 	function __construct(){
	    try{
	        $server = getenv("DB_HOST");
		    $user = getenv("DB_USER");
		    $bd = getenv("DB_NAME");
	        $pwd = getenv("DB_PASS");
		    $this->setCon(new PDO("mysql:host=$server;dbname=$bd",$user,$pwd));
	        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	    }catch(PDOException $ex){
		    echo "{$ex->getMessage()}";
        }
    }

}

