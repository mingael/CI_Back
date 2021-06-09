<?php namespace App\Models;

use CodeIgniter\Model;

class WordContentModel extends Model
{
	protected $table = 'word_content';
	protected $primaryKey = 'idx';	// find() 함수에서 사용

	protected $useAutoIncrement = true;	// 기본키 자동 증가 사용여부

	protected $returnType = 'array';

	protected $useSoftDeletes = true;	// delete 호출 시 deleted_at 필드를 설정
	protected $deletedField = 'status';

	// // save, insert, update 허용 필드
	protected $allowedFields = [
		'word_idx','content','status','stime','dtime'
	];

	protected $useTimestamps = false;
	protected $createdField = '';
	protected $updatedField = '';

	protected $skipValidation = false;
}
?>