<?php
namespace Saphira\Connectdb\Common;

class Enviroment
{

   const SUCCESS = 'Enviroment File Was Found';

    const FAIL = 'Enviroment File Not Found';


    public static function load($dir){
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $fileEnv =  "/.env";
            for($x = 1; $x <= 40; $x++){
                if(dirname($dir,$x) == $rootPath){
                    $rootFolder = dirname($dir,$x);
                    if(file_exists($rootFolder . $fileEnv)){
                        $envs = file($rootFolder . $fileEnv);
                            foreach($envs as $env){
                                putenv(trim($env));
                            }                     
                       return Enviroment::SUCCESS;                
                    }else{ 
                       return Enviroment::FAIL;
                  }
              }
      }
        
        
   }




 }
