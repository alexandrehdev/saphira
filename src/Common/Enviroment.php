<?php
namespace Saphira\Connectdb\Common;

class Enviroment
{

 public static function load($dir){
        $rootFolder = $_SERVER["DOCUMENT_ROOT"];
        $pathEnv =  "/vendor/saphira/connectdb/.env";

        for($x = 1; $x <= 20; $x++){
            if($rootFolder == dirname($dir,$x)){
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
}
