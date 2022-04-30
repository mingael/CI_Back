<?php
#
#	로그인
#

namespace App\Controllers;

use Services\AuthService;

class AuthController extends BaseController
{
	private static $service;

	public function __construct()
	{
		self::$service = new AuthService();
	}

	public function checkBadIp()
	{
		$_POST = json_decode($this->request->getBody(), TRUE);

		$res = self::$service->checkBadIp($_POST['ip']);
		echo json_encode($res);
	}

	public function login()
	{
		$_POST = json_decode($this->request->getBody(), TRUE);

		$res = self::$service->login($_POST);
		echo json_encode($res);
	}
}
?>