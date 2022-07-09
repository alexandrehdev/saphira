<?php
	namespace Saphira\Connectdb\Actions;

	class Dump
	{

    
    /**
     * function responsible for return select query
     *
     * @param string $db
     * @param string $table
     * @return string
     */
    
    public static function selectAll(string $db, string $table) :string{

      return "SELECT * FROM {$db}.{$table}";

    }



    
    /**
     * function responsible for return insert query
     *
     * @param string $db
     * @param string $table
     * @param string $columns
     * @param string $values
     * @return string
     */

    public static function insert(string $db, string $table, string $columns, string $values) :string{

        return "INSERT INTO {$db}.{$table} {$columns} VALUES {$values}";

    }



    /**
     * function responsible for return update query
     *
     * @param string $db
     * @param string $table
     * @param string $columns
     * @param string $condition
     * @return void
     */

    public static function update(string $db, string $table, string $columns, string $condition) :string{

      return "UPDATE {$db}.{$table} SET {$columns} WHERE {$condition}";

    }




    /**
     * function responsible for return delete query
     *
     * @param string $db
     * @param string $table
     * @param string $condition
     * @return string
     */ 

    public static function delete(string $db, string $table, string $condition) :string{

      return "DELETE FROM {$db}.{$table} WHERE {$condition}";

    }

	}
