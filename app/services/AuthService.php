<?php

namespace Services;

use Services\Core\BaseService;
use Repository\AuthRepository;

class AuthService extends BaseService
{
	private static $auth;

	public function __construct()
	{
		self::$auth = new AuthRepository();
	}

	public function checkBadIp($ip)
	{
		$res = self::$auth->checkBadIp($ip);

		return $res;
	}

	public function login($data)
	{
		$data['pwd'] = md5($data['pwd']);

		// 유저 확인
		$customer = self::$auth->checkCustomer($data['email']);
		if(!empty($customer['idx']))
		{
			// 비밀번호 확인
			if($customer['password'] === $data['pwd'])
			{
				// 로그인 실패 5회 미만
				if($customer['login_fail_cnt'] < 5)
				{
					self::$auth->updateLoginFailCnt($customer['idx'], 0);

					$res['res_code'] = 'P000';
					$res['email'] = $data['email'];
					$res['permit'] = 'admin';
				}
				else
				{
					$res['res_code'] = '0003';	// 5회 이상 실패는 로그인 거부
				}
			}
			else
			{
				self::$auth->updateLoginFailCnt($customer['idx'], $customer['login_fail_cnt'] + 1);

				$res['res_code'] = '0002';	// 비밀번호 틀림
			}
		}
		else
		{
			self::$auth->insertBadIp($data['ip'], $data['email'], $data['pwd']);

			$res['res_code'] = '0001';	// 존재하지 않는 유저
		}

		return $res;
	}
}
?>