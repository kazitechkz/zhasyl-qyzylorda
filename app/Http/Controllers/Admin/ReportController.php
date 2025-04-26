<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::orderBy('status','ASC')->paginate(20);
        return view("admin.report.index",compact("reports"));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if($report = Report::find($id)){
            $report->load("marker");
            return view("admin.report.edit",compact("report"));
        }
        toastr()->warning("Не найдено");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["status"=>"required"]);
        if($report = Report::find($id)){
            $report->edit($request->only("answer","status"));
            toastr()->success("Успешно отвечен");
            return redirect()->route("reports.index");
        }
        toastr()->warning("Не найдено");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($report = Report::find($id)){
            $report->delete();
            toastr()->success("Успешно удалено!");
        }
        else{
            toastr()->warning("Не найдено");
        }
        return redirect()->back();
    }
}
