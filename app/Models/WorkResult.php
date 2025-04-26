<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkResult
 *
 * @property int $id
 * @property int $work_id
 * @property int $user_id
 * @property string|null $comment
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Work $work
 * @property Collection|ResultFile[] $result_files
 *
 * @package App\Models
 */
class WorkResult extends Model
{
    use Upload;
	protected $table = 'work_results';

	protected $casts = [
		'work_id' => 'int',
		'user_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'work_id',
		'user_id',
		'comment',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function work()
	{
		return $this->belongsTo(Work::class);
	}

	public function result_files()
	{
		return $this->hasMany(ResultFile::class, 'result_id');
	}
}
