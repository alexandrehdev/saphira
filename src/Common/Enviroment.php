<?php
namespace Saphira\Connectdb\Common;

class Enviroment
{

	public static function load($dir){
    $pathEnv =  "/vendor/saphira/connectdb/.env";

    for($x = 1; $x <= 20; $x++){
      if(dirname($dir,$x) == dirname(getcwd(),1)){
        $rootFolder = dirname($dir,$x);
        $lines = (file_exists($rootFolder . $pathEnv)) ? file($rootFolder . $pathEnv) : null;
          foreach($lines as $line){
            putenv(trim($line));
          }
        return ".env file 200";

        continue;
      }
    }

	}
}
