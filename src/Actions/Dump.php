<?php
namespace Saphira\Connectdb\Actions;

class Dump{
    
    
    public static function getSelectAll(){

        return "SELECT * FROM #db#.#table#";

    }


    public static function getSelectSpecific(){

        return "SELECT #cols# FROM #db#.#table#";

    }
		
   
    public static function getSelectSpecificWhere(){

        return "SELECT #cols# FROM #db#.#table# WHERE #condition#";

    }


    public static function getInsertQuery(){

        return "INSERT INTO #db#.#table# (#cols#) VALUES (#vals#)";

    }


    public static function getUpdateQuery(){

      return "UPDATE #db#.#table# SET #atribuition# WHERE #condition#";

    }


    public static function getDeleteQuery(){

      return "DELETE FROM #db#.#table# WHERE #condition#";

    }

}
