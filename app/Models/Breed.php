<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory, Upload;

    protected $fillable = ['title_ru', 'title_kz','image_url', 'coefficient', 'status', 'type_id',"old_age"];

    public function markers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Marker::class, 'breed_id', 'id');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
