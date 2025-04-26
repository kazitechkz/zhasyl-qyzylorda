<?php
namespace App\Models;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    use Upload;

    protected $fillable = ["marker_id", "name","phone","email","message","answer","status"];

    public function marker(){
        return $this->belongsTo(Marker::class);
    }
}
