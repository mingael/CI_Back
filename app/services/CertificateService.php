<?php

namespace Services;

use Services\Core\BaseService;
use Repository\CertificateRepository;

class CertificateService extends BaseService
{
	private static $certificate;

	function __construct()
	{
		self::$certificate = new CertificateRepository();
	}

	public function getClassList()
	{
		return self::$certificate->getClassListAll();
	}

	public function getClassStudyContent($seg=false)
	{
		if($seg !== false)
		{
			$subject_data = self::$certificate->getSubjectList($seg);
			foreach($subject_data as $subject)
			{
				$idx = $subject->idx;

				$list[$idx]['idx'] = $idx;
				$list[$idx]['title'] = $subject->title;

				$subject_contents = self::$certificate->getSubjectContents($seg, $idx);
				foreach($subject_contents as $contents)
				{
					$list[$idx]['sub'][] = (Array) $contents;
				}
			}
		}

		if(empty($list))
		{
			$list = [];
		}

		return $list;
	}
	
	public function getWordContentAll()
	{
		$word_data = self::$certificate->getWordAll();
		foreach($word_data as $word)
		{
			$idx = $word['idx'];

			$en_title = '';
			if(isset($en_title))
			{
				$en_title.= $word['english'];
			}
			if(isset($word['abbreviation']))
			{
				$en_title = !empty($en_title) ? $word['abbreviation'].', '.$en_title : $word['abbreviation'];
			}
			
			$title = $idx.'. ';
			if(isset($word['hangul']))
			{
				$title.= $word['hangul'];
				if(!empty($en_title))
				{
					$title.= ' ('.$en_title.')';
				}
			}
			else
			{
				$title.= $en_title;
			}

			$list[$idx]['title'] = $title;
			$list[$idx]['summary'] = $word['summary'];

			$word_contents = self::$certificate->getWordContents($idx);
			foreach($word_contents as $word_cont)
			{
				$list[$idx]['contents'][$word_cont['idx']]['content'] = nl2br($word_cont['content']);
			}
		}

		if(empty($list))
		{
			$list = [];
		}

		return $list;
	}
}
?>