<?php

namespace App\Http\Controllers\Brigadier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        return view("brigadier.index");
    }
}
