<?php
    namespace Saphira\Connectdb\Actions;
    use Saphira\Connectdb\Connect\Connection;
    use PDO;

    class DataActions
	{

    public function getConnection(){
      return new Connection();
    }

    public function selectAll(string $table_name) :array{
      $connection = $this->getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::selectAll(getenv("DB_NAME"),$table_name));
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $response = ($row == null) ? "no records found" : $row;

      return $response;  
    }

	    
    public function selectBy(string $table, array $col){
      $cols = implode(", ", $col);
      $connection = $this->getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::selectSpecific(getenv("DB_NAME"),$table, $cols));
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
      return $row;
    }
	    
	    
    public function selectByWhere(string $table, array $col, string $cond, string $val){
      $cols = implode(", ", $col);
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::selectSpecific(getenv("DB_NAME"),$table,$cols,$cond,$val));
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
      return $row;
    }  


    public function insertValues(string $table,array $cols, array $vals) :string{
      $column = "(". implode(",",$cols) . ")";
      $values = "(:". implode(", :", $cols) . ")";
      $data   = array_combine($cols,$vals);
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::insert(getenv("DB_NAME"),$table,$column,$values));

      $response   = ($stmt->execute($data)) ? "success" : "failed";

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
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::update(getenv("DB_NAME"),$table,$format,$condition));
 
      $response = ($stmt->execute()) ? "success" : "failed";
      
      return $response;

     }



     public function deleteValues(string $table, array $cond) :string{
       $condition = $cond[0] . " = " . "'$cond[1]'";
       $connection = self::getConnection();
       $con = $connection->getCon();
       $stmt = $con->prepare(Dump::delete(getenv("DB_NAME"),$table,$condition));
       $response = ($stmt->execute()) ? "success" : "failed";
 
       return $response;
     }



	}
