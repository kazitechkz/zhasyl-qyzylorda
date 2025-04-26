<?php

namespace App\Models;

use App\Traits\Language;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatePolicy extends Model
{
    use HasFactory, Upload, Language;
    protected $table = 'private_policies';
    protected $fillable = ['text_kk', 'text_ru'];
}
