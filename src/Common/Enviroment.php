<?php
namespace Saphira\Connectdb\Common;

use Exception;

class Enviroment
{
    
    private $env;



    public function __construct(){
        $this->env = "/.env";
    }



    public static function load($dir){
       $self = new Static;
       $searchEnv = file_exists($dir . $self->env);
       $envs = ($searchEnv) ? file($dir . $self->env) : false;

       foreach($envs as $env){
          $response = (!empty($env) ? putenv($env) : false);
       }

       return $response;
    }
        
        
}




