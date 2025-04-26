<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Upload;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ["presence","geolocation"];


    public function getPresenceAttribute()
    {
        return null;
    }
    public function getGeolocationAttribute()
    {
        return null;
    }



    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image_url',
        "status"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        "status"=>"boolean"
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function geo()
    {
        return $this->belongsTo(GeoPosition::class, 'id', 'user_id');
    }
    public function user_places()
    {
        return $this->hasMany(UserPlace::class, 'user_id', 'id');
    }

    public function permission(){
        return $this->hasMany(Permission::class, 'user_id', 'id');
    }

    public function can_do($title)
    {
        return $this->hasMany(Permission::class, 'user_id', 'id')->where(["permission" => $title])->exists();
    }
}
