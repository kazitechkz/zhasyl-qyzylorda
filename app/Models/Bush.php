<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bush
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $type_id
 * @property int|null $breed_id
 * @property int|null $sanitary_id
 * @property int|null $place_id
 * @property int|null $area_id
 * @property string|null $image_url
 * @property string $geocode
 * @property string $length
 * @property string $height
 * @property string $width
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Area|null $area
 * @property Breed|null $breed
 * @property Place|null $place
 * @property Sanitary|null $sanitary
 * @property Type|null $type
 * @property User|null $user
 *
 * @package App\Models
 */
class Bush extends Model
{
    use Upload;
	protected $table = 'bushes';

	protected $casts = [
		'user_id' => 'int',
		'type_id' => 'int',
		'breed_id' => 'int',
		'sanitary_id' => 'int',
		'place_id' => 'int',
		'area_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'type_id',
		'breed_id',
		'sanitary_id',
		'place_id',
		'area_id',
		'image_url',
		'geocode',
		'length',
		'height',
		'width'
	];

	public function area()
	{
		return $this->belongsTo(Area::class);
	}

	public function breed()
	{
		return $this->belongsTo(Breed::class);
	}

	public function place()
	{
		return $this->belongsTo(Place::class);
	}

	public function sanitary()
	{
		return $this->belongsTo(Sanitary::class);
	}

	public function type()
	{
		return $this->belongsTo(Type::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
