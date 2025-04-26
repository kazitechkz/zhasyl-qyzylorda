<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class HashToken extends Model
{
    use HasFactory, Upload;
    protected $table = 'hash_tokens';
    protected $fillable = [
      'user_id',
      'file',
      'date',
      'status'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)->format("d.m.Y")
        );
    }

}
