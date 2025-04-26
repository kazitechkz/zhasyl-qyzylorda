<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("chef.dashboard");
    }

}
