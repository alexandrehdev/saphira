<?php

namespace Saphira\Connectdb\Actions;
use Saphira\Connectdb\Actions\Build;
use Saphira\Connectdb\Connect\Connection;
use PDO;



class Action extends Build
{

    private $connect;


    public function __construct()
    {
        parent::__construct(getcwd());

        $this->connect = new Connection;
    }


    public function selectAll()
    {
       $search = ["#db#","#table#"];
       $vals = [getenv("DB_NAME"), $this->getTable()];
       $templateQuery = Dump::getSelectAll();
       $selectAllQuery = str_replace($search,$vals,$templateQuery);
       $connect = $this->connect->getCon();
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
       $connect = $this->connect->getCon();
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
       $connect = $this->connect->getCon();
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
       $connect = $this->connect->getCon();
       $stmt = $connect->prepare($insertQuery);

       return ($stmt->execute()) ? "success" : "fail";
    }



    public function updateValues() :string{
        $templateQuery = Dump::getUpdateQuery();
        $search = ["#db#","#table#","#atribuition#","#condition#"];
        $values = [getenv("DB_NAME"),$this->table,$this->attribuition,$this->condition];
        $updateQuery = str_replace($search,$values,$templateQuery);
        $connect = $this->connect->getCon();
        $stmt = $connect->prepare($updateQuery);
        $stmt->execute();

        return ($stmt->execute()) ? "success" : "fail";
    }


    public function deleteValues() :string{
        $templateQuery = Dump::getDeleteQuery();
        $search = ["#db#","#table#","#condition#"];
        $values = [getenv("DB_NAME"),$this->table,$this->condition];
        $deleteQuery = str_replace($search,$values,$templateQuery);
        $connect = $this->connect->getCon();
        $stmt = $connect->prepare($deleteQuery);
        $stmt->execute();

        return ($stmt->execute()) ? "success" : "fail";
    }
     

}


