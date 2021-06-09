<?php namespace App\Models;

use CodeIgniter\Model;

class WordModel extends Model
{
	protected $table = 'word';
	protected $primaryKey = 'idx';	// find() �Լ����� ���

	protected $useAutoIncrement = true;	// �⺻Ű �ڵ� ���� ��뿩��

	protected $returnType = 'array';

	protected $useSoftDeletes = true;	// delete ȣ�� �� deleted_at �ʵ带 ����
	protected $deletedField = 'status';

	// // save, insert, update ��� �ʵ�
	protected $allowedFields = [
		'hangul','english','abbreviation','summary','status','stime','dtime'
	];

	protected $useTimestamps = false;
	protected $createdField = '';
	protected $updatedField = '';

	protected $skipValidation = false;
/*
	protected var $contrents_idx;
	protected var $contents_sub_idx;
	protected var $hangul;
	protected var $english;
	protected var $abbreviation;
	protected var $status;
	protected var $stime;
	protected var $dtime;
*/
}
?>