<?php
namespace Saphira\Connectdb\Common;


class Enviroment
{
    
    private $fileName;


    private $env;


    private static $instance = null;



    public function __construct(){

        $this->fileName = "/.env";

    }


    public static function getInstance() :object{
        if(self::$instance == null){
            self::$instance = new self;
        }

        return self::$instance;
    }



    public static function load($dir){
        $self = self::getInstance();

        if(file_exists($dir . $self->fileName)){
            $self->env = file($dir . $self->fileName);

            foreach($self->env as $env){
               putenv($env);
            } 
        }

    }
        
        
}




