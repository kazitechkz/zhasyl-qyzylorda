<?php

namespace App\Http\Controllers\Agronomist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agronomist\CreateWorkResultRequest;
use App\Models\ResultFile;
use App\Models\Work;
use App\Models\WorkResult;
use Illuminate\Http\Request;

class WorkResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = WorkResult::where(["user_id" => auth()->id()])->with(["work.chief","user"])->paginate(30);
        return view("agronomist.work-result.index",compact("results"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWorkResultRequest $request)
    {
        if(!$work = WorkResult::where(["work_id" => $request->get("work_id")])->first()){
            $input = $request->all();
            $input["user_id"] = auth()->id();
            $result = WorkResult::add($input);
            if($request->get("files")){
                foreach ($request->get("files") as $file){
                    $resultFile = ResultFile::add(["result_id"=>$result->id]);
                    $resultFile->uploadFile($file,"file_url");
                }
            }
        }
        return redirect()->route("agronomist-work-result.index");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $work = Work::where(["id"=>$id,"user_id" => auth()->id()])->first();
        if($work){
            $result = WorkResult::where(["work_id" => $work->id])->first();
            return view("agronomist.work-result.show",compact("work","result"));
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $work = Work::where(["id"=>$id,"user_id" => auth()->id()])->first();
        if($work){
            $result = WorkResult::where(["work_id" => $work->id])->first();
            if($result){
                return redirect()->route("agronomist-work-result.show",$result->id);
            }
            return view("agronomist.work-result.create",compact("work"));
        }
        return redirect()->back();
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
        if($result = WorkResult::where(["user_id" => auth()->id(),"id"=>$id])->first()){
            $result->delete();
        }
        return redirect()->route("agronomist-work-result.index");
    }
}
