<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * Class Work
 *
 * @property int $id
 * @property int $user_id
 * @property int $chief_id
 * @property int $department_id
 * @property string $title
 * @property string|null $description
 * @property point|null $point
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Department $department
 * @property Collection|WorkResult[] $work_results
 *
 * @package App\Models
 */
class Work extends Model
{
	protected $table = 'works';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'chief_id' => 'int',
		'department_id' => 'int',
		'point' => Point::class,
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'chief_id',
		'department_id',
		'title',
		'description',
		'point',
		'start_at',
		'end_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class,"user_id");
	}
    public function chief()
    {
        return $this->belongsTo(User::class,"chief_id","id");
    }
	public function department()
	{
		return $this->belongsTo(Department::class,"department_id");
	}

	public function work_results()
	{
		return $this->hasMany(WorkResult::class);
	}
}
