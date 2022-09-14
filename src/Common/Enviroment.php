<?php
namespace Saphira\Connectdb\Common;

class Enviroment
{

    public static function load($dir){

       $fileEnv =  "/.env";
       if(file_exists($dir . $fileEnv)){

          $lines = file($dir . $fileEnv);
          foreach($lines as $line){
              putenv(trim($line));
          }

          return ".env 200";

       }else{
          return ".env file not found";
       }

   }

 }
