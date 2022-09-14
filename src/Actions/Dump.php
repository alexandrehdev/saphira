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

        return "SELECT #col# FROM #db#.#table# WHERE #param# = '#val#'";

    }


    public static function getInsertQuery(){

        return "INSERT INTO #db#.#table# ( #cols# ) VALUES ( #vals# )";

    }


    public static function update(){

      return "UPDATE #db#.#table# SET #col# WHERE #condition# = #iqual# ";

    }


    public static function delete(){

      return "DELETE FROM #db#.#table# WHERE #condition# = #iqual# ";

    }

}
