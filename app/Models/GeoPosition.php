<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoPosition extends Model
{
    use HasFactory;
    protected $table = 'geo_positions';
    protected $fillable = ['user_id', 'geocode'];
}
