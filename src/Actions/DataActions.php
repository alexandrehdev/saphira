<?php
namespace Saphira\Connectdb\Actions;
use Saphira\Connectdb\Actions\Dump;
use Saphira\Connectdb\Connect\Connection;
use PDO;
use Saphira\Connectdb\Common\Enviroment;

 /**
 * DataActions 
 * 
 * @package saphira 
 * @version 1.2
 * @copyright 2022 php developer
 * @author alexandrehdev <github.com/alexandrehdev> 
 * @license PHP Version 8.1 
 */

 class DataActions{


    private $table;


    private $columns = [];


    private $values = [];


    private $condition;


    private $attribuition;



    public function getTable() {
        return $this->table;
    }



    public function setTable(string $table){
        $this->table = $table;
    }



    public function getColumns(){
        return $this->columns;
    }



    public function setColumns(string ...$columns){
        $this->columns = implode(",",$columns);
    }



    public function getValues(){
        return $this->values;
    }


    public function setValues(string ...$values){
        $vals = array_map(function($item){
            return "'$item'";
        },$values);

        $this->values = implode(",", $vals);
    }


    public function getCondition(){
       return $this->condition;
    }    


    public function setCondition(string $condition){
       $this->condition = $condition;
    }


    public function getAttribuition(){
       return $this->attribuition;
    }


    public function setAttribuition(string ...$attribuitions){
      $this->attribuition = implode(",", $attribuitions);
    }
    

    public function getConnection(){
       return (new Connection())->getCon();
    }


    function __construct($currentDirectory){

        Enviroment::load($currentDirectory);

    }


    public function selectAll(){
       $search = ["#db#","#table#"];
       $vals = [getenv("DB_NAME"), $this->table];
       $templateQuery = Dump::getSelectAll();
       $selectAllQuery = str_replace($search,$vals,$templateQuery);
       $connect = $this->getConnection();
       $stmt = $connect->prepare($selectAllQuery);
       $stmt->execute();
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $response = ($row == null) ? "no records found" : $row;

       return $response;
    }


    public function selectBy() :array{
       $templateQuery = Dump::getSelectSpecific();
       $search = ["#db#","#table#","#cols#"];
       $values = [getenv("DB_NAME"),$this->table,$this->columns];
       $selectByQuery = str_replace($search,$values,$templateQuery);
       $connect = $this->getConnection();
       $stmt = $connect->prepare($selectByQuery);
       $stmt->execute();
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $row;
    }


      
    public function selectColsWhere() :array{
       $templateQuery = Dump::getSelectSpecificWhere();
       $search = ["#db#","#table#","#cols#","#condition#"];
       $values = [getenv("DB_NAME"),$this->table,$this->columns,$this->condition];
       $selectColsWhereQuery = str_replace($search,$values,$templateQuery);
       $connect = $this->getConnection();
       $stmt = $connect->prepare($selectColsWhereQuery);
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       return $row;
    }
	

    public function insertValues() :string{
       $templateQuery = Dump::getInsertQuery();
       $search = ["#db#","#table#","#cols#","#vals#"];
       $values = [getenv("DB_NAME"),$this->table,$this->columns,$this->values];
       $insertQuery = str_replace($search,$values,$templateQuery);
       $connect = $this->getConnection();
       $stmt = $connect->prepare($insertQuery);

       return ($stmt->execute()) ? "success" : "fail";
    }



    public function updateValues() :string{
        $templateQuery = Dump::getUpdateQuery();
        $search = ["#db#","#table#","#atribuition#","#condition#"];
        $values = [getenv("DB_NAME"),$this->table,$this->attribuition,$this->condition];
        $updateQuery = str_replace($search,$values,$templateQuery);
        $connect = $this->getConnection();
        $stmt = $connect->prepare($updateQuery);
        $stmt->execute();

        return ($stmt->execute()) ? "success" : "fail";
    }


    public function deleteValues() :string{
        $templateQuery = Dump::getDeleteQuery();
        $search = ["#db#","#table#","#condition#"];
        $values = [getenv("DB_NAME"),$this->table,$this->condition];
        $deleteQuery = str_replace($search,$values,$templateQuery);
        $connect = $this->getConnection();
        $stmt = $connect->prepare($deleteQuery);
        $stmt->execute();

        return ($stmt->execute()) ? "success" : "fail";
    }
    


}
