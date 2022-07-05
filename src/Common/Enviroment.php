<?php
namespace Saphira\Connectdb\Common;

class Enviroment
{

	public static function load($dir){
    $pathEnv =  "/vendor/masterbase/connectdb/.env";

    for($v = 1; $v <= 20; $v++){
      $rootFolder = (dirname($dir, $v) == $_SERVER['DOCUMENT_ROOT']) ? dirname($dir, $v) : null;
      $lines = (file_exists($rootFolder . $pathEnv)) ? file($rootFolder . $pathEnv): null;
      if($lines){
        foreach($lines as $line){
            putenv(trim($line));
        }
        return ".env file 200";
      }
    }

	}
}
