<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultFile
 *
 * @property int $id
 * @property string $file_url
 * @property int $result_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property WorkResult $work_result
 *
 * @package App\Models
 */
class ResultFile extends Model
{
    use Upload;
	protected $table = 'result_files';

	protected $casts = [
		'result_id' => 'int'
	];

	protected $fillable = [
		'file_url',
		'result_id'
	];

	public function work_result()
	{
		return $this->belongsTo(WorkResult::class, 'result_id');
	}
}
