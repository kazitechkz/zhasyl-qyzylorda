<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class BackupController extends Controller
{
    public function index(){
        $files = Storage::disk('local')->allFiles('backups');
        return view("admin.backups.index",compact("files"));
    }

    public function delete(Request $request){
        $path = $request->get("path");
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
            toastr()->success("Файл удален");
        }else{
            toastr()->error("Файл не найден");
        }
        return redirect()->back();
    }
}
