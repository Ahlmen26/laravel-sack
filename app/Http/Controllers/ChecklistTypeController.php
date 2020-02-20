<?php

namespace App\Http\Controllers;

use App\ChecklistType;
use Illuminate\Http\Request;

class ChecklistTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return create page
        return view('checklistmanagerforms.create-checklist-type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ChecklistType $checklisttype)
    {
        //
        $attributes = $this->validateAttributes();

        ChecklistType::create($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChecklistType  $checklistType
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistType $checklistType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChecklistType  $checklistType
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistType $checklisttype)
    {
        // Return page for editing checklist type
        return view('checklistmanagerforms.edit-checklist-type', [
            'checklisttype' => $checklisttype
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChecklistType  $checklistType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistType $checklisttype)
    {
        // Update checklist type and return to Checklist Manager page
        $attributes = $this->validateAttributes();

        $checklisttype->update($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChecklistType  $checklistType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistType $checklistType)
    {
        //
    }
    public function validateAttributes(){
        return request()->validate([
            'type' => 'required',
        ]);
    }
}
