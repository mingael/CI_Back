<?php

namespace Repository;

use Repository\Core\BaseRepository;

class CertificateRepository extends BaseRepository
{
	/**
	 *	과목 전체
	 *
	 */
	public function getClassListAll()
	{
		$this->dbInit('class');

		return self::$builder
			->select('idx, title')
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	과목 수업 목록
	 *
	 */
	public function getSubjectList($class_idx)
	{
		$this->dbInit('subject');

		return self::$builder
			->select('idx, title')
			->where('class_idx', $class_idx)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	과목 수업 주제
	 *
	 */
	public function getSubjectLabel($subject_idx)
	{
		$this->dbInit('subject_label');

		return self::$builder
			->select('idx, comment')
			->where('subject_idx', $subject_idx)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	과목 수업 주제별 내용
	 *
	 */
	public function getSubjectContents($label_idx)
	{
		$this->dbInit('content');

		return self::$builder
			->select('*')
			->where('label_idx', $label_idx)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	특정 단어
	 *
	 */
	public function getWord($idx)
	{
		$this->dbInit('word');

		return self::$builder
			->select('idx, parent_idx, hangul, english, abbreviation, keyword, summary')
			->where('idx', $idx)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	단어 전체
	 *
	 */
	public function getWordAll()
	{
		$this->dbInit('word');

		return self::$builder
			->select('*')
			->where('status', 'Y')
			->orderBy('parent_idx', 'ASC')
			->orderBy('idx', 'ASC')
			->get()->getResultArray();
	}

	/**
	 *	단어 내용
	 *
	 */
	public function getWordContents($word_idx)
	{
		$this->dbInit('word_content');

		return self::$builder
			->select('idx, content')
			->where('Word_idx', $word_idx)
			->where('status', 'Y')
			->get()->getResultArray();
	}

	/**
	 *	연관 단어가 없는 단어
	 *
	 */
	public function getParentWord()
	{
		$this->dbInit('word');

		return self::$builder
			->select('idx, title')
			->getwhere()
			->get()->getResultArray();
	}
}
?>