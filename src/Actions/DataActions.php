<?php
namespace Saphira\Connectdb\Actions;
use Saphira\Connectdb\Connect\Connection;
use PDO;
use Saphira\Connectdb\Common\Enviroment;

 /**
 * DataActions 
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */

 class DataActions{

  /**
   * @var database 
   * @type string
   */

    private string $db;

    private string $table;

    private $columns = [];

    private $values = [];

    private Connection $con;

    public function getDatabase(){
        return $this->db;
    }

    public function setDatabase(string $database){
        $this->database = $database;
    }

    public function getTable(){
        return $this->table;
    }

    public function setTable(string $table){
        $this->table = $table;
    }

    public function getColumns(){
        return $this->columns;
    }

    public function setColumns(array $columns){
        $this->columns = $columns;
    }

    public function getValues(){
        return $this->values;
    }

    public function setValues(array $values){
        $this->values = $values;
    }


    function __construct($currentDirectory)
    {
        Enviroment::load($currentDirectory);

        $this->con = (new Connection())->getCon();
    }

    public function getConnection() :object{
       $connection = new Connection();
       return $connection->getCon();
    }
    

    public function selectAll(){
       $search = ["#db#","#table#"];
       $vals = [$this->db, $this->table];
       $brokenQuery = Dump::getSelectAll();
       $selectAllQuery = str_replace($search,$vals,$brokenQuery);
       $connect = $this->getConnection();
       $stmt = $connect->prepare($selectAllQuery);
       $stmt->execute();
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $response = ($row == null) ? "no records found" : $row;

       return $response;
    }


    public function selectBy(){
       $selectByQuery = Dump::getSelectSpecific();
       $connect = $this->getConnection();
       $cols = implode(",", $this->columns);
       $stmt = $connect->prepare($selectByQuery);
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       return $row;
     }


      
    public function selectWhere(){
      $selectWhereQuery = Dump::selectSpecificWhere($this->database,$this->tableName,$this->columns);
      $cols = implode(", ", $this->columns);
      $connect = $this->getConnection();

    }
	
	    
	    
    public function selectByWhere(string $table, array $col, string $cond, string $val){
     $cols = implode(", ", $col);
     $connect = $this->getConnection();
     $stmt = $connect->prepare(Dump::selectSpecific(getenv("DB_NAME"),$table,$cols,$cond,$val));
     $stmt->execute();
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
     return $row;
    }  


    public function insertValues(string $table,array $cols, array $vals) :string{
      $column = "(". implode(",",$cols) . ")";
      $values = "(:". implode(", :", $cols) . ")";
      $data = array_combine($cols,$vals);
      $connect = $this->getConnection();
      $stmt = $connect->prepare(Dump::insert(getenv("DB_NAME"),$table,$column,$values));

      $response = ($stmt->execute($data)) ? "success" : "failed";

      return $response;
    }



    public function updateValues(string $table, array $cols, array $vals, array $cond) :string{
      $vals = array_map(function($item){
         return "--$item--";
      },$vals);
      $format = array_combine($cols,$vals);
      $format = http_build_query($format,'',' , ');
      $format = str_replace("=", " = ",$format);

      foreach($vals as $val){
        $format = str_replace("--", " ' ", $format);
      }

      $condition = $cond[0] . " = " . $cond[1];
      $connect = $this->getConnection();
      $stmt = $connect->prepare(Dump::update(getenv("DB_NAME"),$table,$format,$condition));
 
      $response = ($stmt->execute()) ? "success" : "failed";
      
      return $response;

     }
    


     public function deleteValues(string $table, array $cond) :string{
       $condition = $cond[0] . " = " . "'$cond[1]'";
       $connect = $this->getConnection();
       $stmt = $connect->prepare(Dump::delete(getenv("DB_NAME"),$table,$condition));
       $response = ($stmt->execute()) ? "success" : "failed";

       return $response;
     }



	}
