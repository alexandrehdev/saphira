<?php
namespace Saphira\Connectdb\Actions;
use Saphira\Connectdb\Actions\Dump;
use Saphira\Connectdb\Connect\Connection;
use PDO;
use Saphira\Connectdb\Common\Enviroment;

 /**
 * DataActions 
 * 
 * @package saphira 
 * @version 1.2
 * @copyright 2022 php developer
 * @author alexandrehdev <github.com/alexandrehdev> 
 * @license PHP Version 8.1 
 */

 class Build{


    private $table;


    private $columns = [];


    private $values = [];


    private $condition;


    private $attribuition;



    function __construct($dir){

       Enviroment::load($dir);

    }


    protected function getTable()
    {
        return $this->table;
    }



    public function setTable(string $table)
    {
        $this->table = $table;
    }



    protected function getColumns()
    {
        return $this->columns;
    }



    public function setColumns(string ...$columns)
    {
        $this->columns = implode(",",$columns);
    }



    protected function getValues()
    {
        return $this->values;
    }


    public function setValues(string ...$values)
    {
        $vals = array_map(function($item){
            return "'$item'";
        },$values);

        $this->values = implode(",", $vals);
    }


    protected function getCondition()
    {
       return $this->condition;
    }    


    public function setCondition(string $condition)
    {
       $this->condition = $condition;
    }


    protected function getAttribuition()
    {
       return $this->attribuition;
    }


    public function setAttribuition(string ...$attribuitions) :void
    {
       $this->attribuition = implode(",", $attribuitions);
    }
    


    


    


}
