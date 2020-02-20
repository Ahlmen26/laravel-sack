<?php

namespace App\Http\Controllers;

use App\ChecklistCategory;
use App\ChecklistType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ChecklistCategoryController extends Controller
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
        // Return create page including the list of checklist types
        return view('checklistmanagerforms.create-checklist-category', [
            'checklistypes' => ChecklistType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ChecklistCategory $checklistcategory)
    {
        //
        $attributes = $this->validateAttributes();

        ChecklistCategory::create($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChecklistCategory  $checklistCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistCategory $checklistCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChecklistCategory  $checklistCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistCategory $checklistcategory, ChecklistType $checklistypes)
    {

        // Return edit page including the category and list of checklist types
        return view('checklistmanagerforms.edit-checklist-category', [
            'checklistcategory' => $checklistcategory,
            'checklisttypes' => $checklistypes->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChecklistCategory  $checklistCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistCategory $checklistcategory)
    {
        // validate inputs
        $attributes = request()->validate([
            'category_name' => 'required',
        ]);

        // Update category
        $checklistcategory->update($attributes);

        // Redirect back to checklist manager page
        return redirect('checklist-manager');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChecklistCategory  $checklistCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistCategory $checklistCategory)
    {
        //
    }
    public function validateAttributes(){
        return request()->validate([
            'checklist_type' => 'required',
            'category_name' => [
                 'required',
                 Rule::unique('checklist_categories')->where(function ($query) {
                    return $query->where('checklist_type', request('checklist_type'));
                 }),
            ]
        ],
        [
            'category_name.unique' => 'The category name and checklist type has already been taken.'
        ]);
    }
}
