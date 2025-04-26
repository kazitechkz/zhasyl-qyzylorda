<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory,Upload;
    protected $table = "user_permision";

    protected $fillable = ['user_id', 'permission'];


    public function can($title){
        return $this->where(["permission" => $title])->exists();
    }
}
