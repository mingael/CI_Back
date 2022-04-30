<?php

namespace Repository;

use Repository\Core\BaseRepository;

class DevRepository extends BaseRepository
{
	function getTest()
	{
		$this->dbInit('word_content');

		return self::$builder
			->select('*')
			->get()->getResultArray();
	}
}
?>