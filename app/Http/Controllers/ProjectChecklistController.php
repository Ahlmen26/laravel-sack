<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\ChecklistCategory;
use App\ChecklistType;
use App\ProjectChecklist;
use App\ProjectChecklistType;
use App\ProjectItemComments;
use App\Projects;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectChecklist $checklist_item, Checklist $checklist, Projects $project_checklist, ProjectItemComments $comments, ChecklistCategory $checklist_category, ChecklistType $checklist_type, $mode, User $users)
    {
        $survey_phase = 0;

        if(request('survey_phase') == 'initial'){
             $survey_phase = 1;
        }elseif(request('survey_phase') == 'lockdown'){
             $survey_phase = 2;
        }
        $checklist_id = $checklist_type->where('type',request('checklisttype'))->value('id');

        $check_items = $project_checklist->project_checklist()->where('user_id', auth()->id())->where('checklist_type',$checklist_id)->where('project_id', $project_checklist->id)->where('survey_phase', $survey_phase);
        
        if($check_items->count() == 0){
            foreach($checklist->where('checklist_type',$checklist_id)->get() as $item){
                ProjectChecklist::create([
                    'survey_type' => $item->survey_type,
                    'survey_phase' => $survey_phase,
                    'checklist_type' => $checklist_id,
                    'category' => $item->category,
                    'project_id' => request('project_checklist')->id,
                    'user_id' => auth()->id(),
                    'checklist_id' => $item->id,
                    'jira_temp_id' => $item->jira_temp_id,
                    'item_status' => 1,
               ]);
            }
        }
        
        $this->authorize('show', $project_checklist);

        return view('project.project-checklist',[
            'project' => $project_checklist,
            'checklist_category' => $checklist_category->where('checklist_type', $checklist_id)->get(),
            'checklist_type' => $checklist_type->where('type',request('checklisttype'))->value('type'),
            'project_checklist' => $project_checklist->project_checklist()->where('user_id', auth()->id())->where('survey_type', $project_checklist->survey_type)->where('checklist_type', $checklist_id)->where('survey_phase', $survey_phase)->get(),
            'proofer_checklist' => $project_checklist->project_checklist()->where('survey_type', $project_checklist->survey_type)->where('checklist_type', $checklist_id)->where('survey_phase', $survey_phase)->get(),
            'checklist_item' => $checklist->all(),
            // 'project_checklist_type' => $project_checklist->checklist_types->get(0),
            'comments_item' => $comments->get(),
            'survey_phase' => $survey_phase,
            'initial_proofer' => $users->where('id', $project_checklist->proofer)->value('name'),
            'lockdown_proofer' => $users->where('id', $project_checklist->proofer2)->value('name'),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectChecklist $projectChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectChecklist $projectChecklist)
    {
        if(request('item_status_ok') == 1){
            $method = 'itemStatus';
        }
        if(request('item_status_ok') == 0){
            $method = 'item_withComments';
        }
        if(request('item_status_ok') == 2){
            $method = 'item_notApplicable';
        }
        // if(request('item_status_ok') == 3){
        //     $method = 'itemStatus';
        // }

        $projectChecklist->$method();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectChecklist $projectChecklist)
    {
        //
    }
}
