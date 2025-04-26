<?php
namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitaryType extends Model {


    use HasFactory, Upload;

    protected $fillable = ['sanitary_id', 'type_id',"image_url"];
    protected $table = 'sanitary_type';

    public function sanitary()
    {
        return $this->belongsTo(Sanitary::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

}
