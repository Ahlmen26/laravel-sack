<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\ChecklistType;
use App\SurveyType;
use App\ChecklistCategory;
use App\JiraTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role:role_Admin']);

    }
    public function index(SurveyType $surveyTypes, ChecklistType $checklistTypes, ChecklistCategory $checklistCategories, Checklist $checklist, JiraTemplate $jiraTemplate)
    {
        // Join table and return data
        $joinedTable = DB::table('checklist_categories as cc')
                        ->join('checklist_types as ct', 'ct.id', 'cc.checklist_type')
                        ->select('cc.*', 'ct.type')->get();

        return view('checklist-manager', [
            'surveyTypes' => $surveyTypes->all(),
            'checklistTypes' => $checklistTypes->all(),
            'checklistCategories' =>  $joinedTable,
            'checklists' => $checklist->all(),
            'jira_templates' => $jiraTemplate->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ChecklistCategory $checklistCategory, ChecklistType $checklistType, SurveyType $surveyType, JiraTemplate $jiraTemplate)
    {
        // Return the create checklist form
        return view('checklistmanagerforms.create-checklist-item', [
            'categories' => $checklistCategory->all(),
            'checklist_types' => $checklistType->all(),
            'survey_types' => $surveyType->all(),
            'jira_templates' => $jiraTemplate->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add checklist item to the database
        $attributes = $this->validateData();

        Checklist::create($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist_manager, ChecklistCategory $checklistCategory, ChecklistType $checklistType, 
        SurveyType $surveyType, JiraTemplate $jiraTemplate)
    {
        //
        return view('checklistmanagerforms.edit-checklist',[
            'checklist' => $checklist_manager,
            'categories' => $checklistCategory->all(),
            'checklist_types' => $checklistType->all(),
            'survey_types' => $surveyType->all(),
            'jira_templates' => $jiraTemplate->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist_manager)
    {
        //
        $attributes = request()->validate([
            'description' => 'required',
            'category' => 'required',
            'checklist_type' => 'required',
            'survey_type' => 'required',
            'jira_temp_id' => 'required',
        ]);

        $checklist_manager->update($attributes);

        return redirect('checklist-manager');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        //
    }
    // Validate form data
    public function validateData(){
        return request()->validate([
            'description' => 'required',
            'category' => 'required',
            'checklist_type' => 'required',
            'survey_type' => 'required',
            'jira_temp_id' => 'required',
        ]);
    }
}
