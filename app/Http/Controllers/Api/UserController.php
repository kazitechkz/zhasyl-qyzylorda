<?php

namespace App\Http\Controllers\Api;

use App\Events\UserLocation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_presence(string $userId, string $location){
        event(new UserLocation($userId,$location));
    }
}
