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
 * Class Department
 *
 * @property int $id
 * @property string $title
 * @property int $chief_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|User[] $users
 * @property Collection|Work[] $works
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'departments';
    use Upload;
	protected $casts = [
		'chief_id' => 'int'
	];

	protected $fillable = [
		'title',
		'chief_id'
	];

	public function chief()
	{
		return $this->belongsTo(User::class, 'chief_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'department_users')
					->withPivot('id')
					->withTimestamps();
	}

	public function works()
	{
		return $this->hasMany(Work::class);
	}
}
