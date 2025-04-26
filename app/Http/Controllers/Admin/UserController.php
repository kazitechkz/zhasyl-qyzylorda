<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(20);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required',
           'role_id' => 'required'
        ]);
        User::add($request->all());
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('user_places.place')->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }


    public function stats(string $id){
        $user = User::find($id);
        if($user){
            if($user->role_id == 2){
                $total = Marker::where(["user_id" => $id])->count();
                $info_day = DB::table('markers')
                    ->where("user_id",$id)
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();
                $info_month = DB::table('markers')
                    ->where("user_id",$id)
                    ->select(DB::raw('count(*) as total'),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                    ->groupby('year','month')
                    ->get();
                $breed_day = Marker::where(["user_id" =>  $id])->select(
                    DB::raw('DATE(created_at) as date_created'),
                    'breed_id',
                    DB::raw('COUNT(*) as count')
                )
                    ->groupBy(DB::raw('DATE(created_at)'), 'breed_id')
                    ->orderBy(DB::raw('DATE(created_at)'))
                    ->orderBy('breed_id')
                    ->with(["breed"])
                    ->get();

                $breed_day = $breed_day->groupBy("date_created")->toArray();
                return view("admin.user.stats",compact("info_day","info_month","total","user","breed_day"));
            }
        }
        return redirect()->back();
    }
}
