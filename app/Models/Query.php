<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $table = 'queries';
    use HasFactory, Upload;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'text',
        'status'
    ];
}
