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

	public function getClassStudyContent($class_idx=0)
	{
		if($class_idx > 0)
		{
			// 과목 수업 목록
			$subject_data = self::$certificate->getSubjectList($class_idx);
			foreach($subject_data as $subject)
			{
				$subject_idx = $subject['idx'];

				$list[$subject_idx]['idx'] = $subject_idx;
				$list[$subject_idx]['title'] = $subject['title'];

				// 수업 주제 ?
				$subject_labels = self::$certificate->getSubjectLabel($subject_idx);
				foreach($subject_labels as $label)
				{
					$list[$subject_idx]['list'][$label['idx']]['comment'] = $label['comment'];

					// 주제 내용
					$subject_contents = self::$certificate->getSubjectContents($lable['idx']);
					foreach($subject_contents as $contents)
					{
						$list[$subject_idx]['list'][$lable['idx']]['sub'][] = $contents;
					}
				}
			}
		}

		if(empty($list))
		{
			$list = [];
		}

		return $list;
	}

	public function getWord($word_idx)
	{
		$word = self::$certificate->getWord($word_idx);

		$word_data = $word[0];

		return $word_data;
	}

	/**
	 *	전체 단어 전제 내용
	 *
	 */
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
			
			$title = sprintf('%03d', $idx).'. ';
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