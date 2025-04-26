<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Area extends Model
{
    use HasFactory;
    use Upload;

    protected $fillable = [
        'title_ru',
        'title_kz',
        'description_ru',
        'description_kz',
        'image_url',
        'geocode',
        'bg_color'
    ];


    public function places() : HasMany
    {
        return $this->hasMany(Place::class,"area_id","id");
    }

    public function markers() : HasManyThrough
    {
        return $this->hasManyThrough(Marker::class, Place::class, 'area_id', 'place_id','id','id');
    }

    public function get_markers_age_5() {
        return $this->markers()->where('age', '<', 5);
    }
    public function get_markers_age_5_15() {
        return $this->markers()->whereBetween('age', [5,15]);
    }
    public function get_markers_age_15_30() {
        return $this->markers()->whereBetween('age', [15,30]);
    }
    public function get_markers_age_30_50() {
        return $this->markers()->whereBetween('age', [30,50]);
    }
    public function get_markers_age_50_100() {
        return $this->markers()->whereBetween('age', [50,100]);
    }
    public function get_markers_age_100() {
        return $this->markers()->where('age', '>', 100);
    }
    public function get_street_markers(): \MatanYadaev\EloquentSpatial\SpatialBuilder|HasManyThrough
    {
        return $this->markers()->whereHas('place.category', function ($query){
            return $query->whereIn('id', [1,2]);
        });
    }

    public function get_park_markers(): \MatanYadaev\EloquentSpatial\SpatialBuilder|HasManyThrough
    {
        return $this->markers()->whereHas('place.category', function ($query){
            return $query->where('id', 2);
        });
    }

    public function user_places() : HasManyThrough
    {
        return $this->hasManyThrough(UserPlace::class, Place::class, 'id', 'place_id', 'area_id', 'id');
    }
}
