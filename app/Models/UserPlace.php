<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
    use HasFactory, Upload;
    protected $table = 'user_places';
    protected $fillable = ['user_id', 'place_id'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
