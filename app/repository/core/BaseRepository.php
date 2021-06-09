<?php

namespace Repository\Core;

abstract class BaseRepository
{
	private static $db;
	public static $builder;

	public function __construct()
	{
		self::$db = db_connect();
	}

	public function __destruct()
	{
		self::$db->close();
	}

	protected function dbInit($table_name)
	{
		self::$builder = self::$db->table($table_name);
	}
}
?>