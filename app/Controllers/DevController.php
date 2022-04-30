<?php
#
#	테스트
#

namespace App\Controllers;

use Repository\DevRepository;

class DevController extends BaseController
{
	private static $repo;

	public function __construct()
	{
		self::$repo = new DevRepository();
	}

	public function index()
	{
		$data = self::$repo->getTest();
//		echo '<pre>'.print_r($data, TRUE).'</pre>';
		echo json_encode($data);
	}
}
?>