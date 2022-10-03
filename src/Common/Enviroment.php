<?php
namespace Saphira\Connectdb\Common;


class Enviroment
{
    
    private $env;


    private static $instance = null;



    public function __construct(){
        $this->env = "/.env";
    }


    public static function getInstance() :object{
        if(self::$instance == null){
            self::$instance = new self;
        }

        return self::$instance;
    }



    public static function load($dir){
       $self = self::getInstance();
       $searchEnv = file_exists($dir . $self->env);
       $envs = ($searchEnv) ? file($dir . $self->env) : false;

       foreach($envs as $env){
          return (!empty($env) ? putenv($env) : false);
       }
    }
        
        
}




