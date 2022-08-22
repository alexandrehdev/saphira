<?php
	namespace Saphira\Connectdb\Actions;
    use Saphira\Connectdb\Connect\Connection;
    use PDO;

    class DataActions
	{

    const SUCCESS = "success";

    const FAILED = "failed";


    public static function getConnection(){

      return new Connection();

    }

    public static function selectAll(string $table_name) :array{
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::selectAll(getenv("DB_NAME"),$table_name));
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $response = ($row == null) ? "no records found" : $row;

      return $response;  
    }

    public static function selectBy(string $table, array $col){
      $cols = implode(", ", $col);
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::selectSpecific(getenv("DB_NAME"),$table, $cols));
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
    }


    public static function insertValues(string $table,array $cols, array $vals) :string{
      $column = "(". implode(",",$cols) . ")";
      $values = "(:". implode(", :", $cols) . ")";
      $data   = array_combine($cols,$vals);
      $connection = self::getConnection();
      $con = $connection->getCon();
      $stmt = $con->prepare(Dump::insert(getenv("DB_NAME"),$table,$column,$values));

      $response   = ($stmt->execute($data)) ? DataActions::SUCCESS : DataActions::FAILED;

      return $response;
    }



    public static function updateValues(string $table, array $cols, array $vals, array $cond) :string{
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
 
      $response = ($stmt->execute()) ? DataActions::SUCCESS : DataActions::FAILED;
      
      return $response;

     }



     public static function deleteValues(string $table, array $cond) :string{
       $condition = $cond[0] . " = " . "'$cond[1]'";
       $connection = self::getConnection();
       $con = $connection->getCon();
       $stmt = $con->prepare(Dump::delete(getenv("DB_NAME"),$table,$condition));
       $response = ($stmt->execute()) ? DataActions::SUCCESS : DataActions::FAILED;
 
       return $response;
     }



	}
