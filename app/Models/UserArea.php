<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserArea
 *
 * @property int $id
 * @property int $user_id
 * @property int $area_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Area $area
 * @property User $user
 *
 * @package App\Models
 */
class UserArea extends Model
{
	protected $table = 'user_areas';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'area_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'area_id'
	];

	public function area()
	{
		return $this->belongsTo(Area::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
