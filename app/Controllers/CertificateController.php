<?php
#
#	정보처리기사
#

namespace App\Controllers;

use Services\CertificateService;

class CertificateController extends BaseController
{
	private static $service;

	function __construct()
	{
		self::$service = new CertificateService();
	}

	function __destruct()
	{
	}

	/**
	 *	과목 목록
	 *
	 */
	public function getClassList()
	{
		$list_data = self::$service->getClassList();

		echo json_encode($list_data);
	}

	/**
	 *	과목 주제별 내용
	 *
	 */
	public function getClassStudyContent()
	{
		$body = json_decode($this->request->getBody(), TRUE);
		$list_data = self::$service->getClassStudyContent($body['class_idx']);

		echo json_encode($list_data);
	}

	public function getWord()
	{
		$body = json_decode($this->request->getBody(), TRUE);
		$list_data = self::$service->getWord($body['word_idx']);

		echo json_encode($list_data);
	}

	/**
	 *	단어 전체
	 *
	 */
	public function getWordAll()
	{
		$list_data = self::$service->getWordContentAll();

		echo json_encode($list_data);
	}
}
?>
