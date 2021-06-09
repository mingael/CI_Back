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
	 *	과목 수업 내용
	 *
	 */
	public function getSubjectContents($class_idx, $subject_idx)
	{
		$this->dbInit('contents');

		return self::$builder
			->select('*')
			->where('class_idx', $class_idx)
			->where('subject_idx', $subject_idx)
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
}
?>