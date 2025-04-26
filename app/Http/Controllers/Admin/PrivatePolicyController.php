<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivatePolicy;
use Illuminate\Http\Request;

class PrivatePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = PrivatePolicy::all();
        return view('admin.policy.index', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.policy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text_kk' => 'required',
            'text_ru' => 'required'
        ]);
        PrivatePolicy::add($request->all());
        toastr('Успешно создан!');
        return redirect(route('private-policy.index'));
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
        $policy = PrivatePolicy::findOrFail($id);
        return view('admin.policy.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
           'text_kk' => 'required',
           'text_ru' => 'required'
        ]);
        $policy = PrivatePolicy::findOrFail($id);
        $policy->edit($request->all());
        toastr('Документ успешно обновлен!', 'info');
        return redirect(route('private-policy.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
