<?php
	namespace Saphira\Connectdb\Actions;
	use Saphira\Connectdb\Connect\Connection;

	class Dump
	{

    public static function selectAll(string $db, string $table) :string{

      return "SELECT * FROM {$db}.{$table}";

    }

    public static function insert(string $db, string $table, string $columns, string $values){

        return "INSERT INTO {$db}.{$table} {$columns} VALUES {$values}";

    }

    public static function update(string $db, string $table, string $columns, string $condition){

      return "UPDATE {$db}.{$table} SET {$columns} WHERE {$condition}";

    }

    public static function delete(string $db, string $table, string $condition){

      return "DELETE FROM {$db}.{$table} WHERE {$condition}";

    }

	}
