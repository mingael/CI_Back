<?php

namespace Repository;

use Repository\Core\BaseRepository;

class AuthRepository extends BaseRepository
{
	/**
	 *	차단 IP 확인
	 *
	 */
	public function checkBadIp($ip)
	{
		$this->dbInit('bad_ip');

		return self::$builder
			->select('idx')
			->where('ip', $ip)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	유저 확인
	 *
	 */
	public function checkCustomer($email)
	{
		$this->dbInit('customer');

		$res = self::$builder
			->select('idx, password, login_fail_cnt')
			->where('email', $email)
			->where('status', 'Y')
			->get()->getResultArray();

		return $res[0];
	}

	/**
	 *	로그인 실패
	 *
	 */
	public function updateLoginFailCnt($idx, $login_fail_cnt)
	{
		$this->dbInit('customer');

		return self::$builder
			->set('login_fail_cnt', $login_fail_cnt)
			->where('idx', $idx)
			->update();
	}

	public function insertBadIp($ip, $email, $password)
	{
		return self::$builder
			->set('ip', $ip)
			->set('email', $email)
			->set('password', $password)
			->insert();
	}
}
?>