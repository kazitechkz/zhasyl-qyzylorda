<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    use HasFactory, Upload;
    protected $table = 'consumers';
    protected $fillable = ['user_id', 'area_id'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
