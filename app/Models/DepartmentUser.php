<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Department $department
 * @property User $user
 *
 * @package App\Models
 */
class DepartmentUser extends Model
{
	protected $table = 'department_users';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'department_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'department_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
