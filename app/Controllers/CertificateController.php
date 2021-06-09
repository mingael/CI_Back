<?php
#
#	정보처리기사
#

namespace App\Controllers;

use Services\CertificateService;

class CertificateController extends BaseController
{
	private static $certificate;

	function __construct()
	{
		self::$certificate = new CertificateService();
	}

	function __destruct()
	{
	}

	public function getClassList()
	{
		$list_data = self::$certificate->getClassList();

		echo json_encode($list_data);
	}

	public function getClassStudyContent($seg=false)
	{
		$list_data = self::$certificate->getClassStudyContent($seg);

		echo json_encode($list_data);
	}
	
	public function getWordAll()
	{
		$list_data = self::$certificate->getWordContentAll();

		echo json_encode($list_data);
	}
}
?>
