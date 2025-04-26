<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanitary extends Model
{
    use HasFactory, Upload;
    protected $fillable = ['title_ru', 'title_kz',"image_url"];

    public function markers()
    {
        return $this->hasMany(Marker::class, 'sanitary_id', 'id');
    }
}
