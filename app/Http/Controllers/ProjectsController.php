<?php

namespace App\Http\Controllers;

use App\JiraTemplate;
use App\ProjectChecklist;
use App\Projects;
use App\SurveyType;
use App\User;
use Illuminate\Http\Request;
use App\ProjectItemComments;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Projects $projects, User $users, SurveyType $surveytype, ProjectChecklist $project_checklist)
    {
        return view('dashboard',[
            'projects' => $projects->where('owner', auth()->id())->get(),
            'qa_request_initial' => $projects->where('status', 0)->get(),
            'qa_request_lockdown' => $projects->where('status', 0)->get(),
            'qa_status' => $project_checklist->all(),
            'proofers' => $users->get(),
            'surveytype' => $surveytype->get(),
            'completed_qa_initial' => $projects->whereIn('survey_phase', [1,2])->get(),
            'completed_qa_lockdown' => $projects->whereIn('survey_phase', [1,2])->get()
        ]);
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
    public function store(Projects $project)
    {
        $attributes = $this->validateProject();
        $attributes['owner'] = auth()->id();
        $attributes['survey_type'] = request('survey_type');
        $attributes['proofer'] = request('proofer');
        $attributes['proofer2'] = 0;
        $attributes['survey_phase'] = 0;
        $attributes['status'] = 3;

        $project = Projects::create($attributes);

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project, User $users)
    {
        return view('project.show',[
            'projects' => $project->where('owner', auth()->id())->get(),
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $project, User $users)
    {
        //
        return view('project.edit-project', [
            // 'project' => $project->where('id', $request->project)->get()
            'project' => $project,
            'users' => $users->get(),
            'initial_proofer' => $users->where('id', $project->proofer)->value('name'),
            'lockdown_proofer' => $users->where('id', $project->proofer2)->value('name'),
        ]);
    }
    public function updateProject(Projects $project){

        request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'osi' => ['required', 'min:4', 'max:255']
        ]);

        $project->update([
            'name' => request('name'),
            'osi' => request('osi'),
            'proofer' => request('proofer'),
            'proofer2' => request('proofer2'),
        ]);

        return back();
    }

    public function ResultsView(Request $request, Projects $project, ProjectChecklist $result_checklist, ProjectItemComments $comments, JiraTemplate $jiraTemplate){
        
        $current_phase = request('phase') == 'initial' ? 1 : (request('phase') == 'lockdown' ? 2 : '');

        return view('project.result', [
            'project' => $project,
            'project_checklist' => $result_checklist->where('project_id', $project->id)->where('user_id', auth()->id())->where('survey_phase', $current_phase)->get(),
            'comments' => $comments->get(),
            'jira_templates' => $jiraTemplate->all()
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projects $project)
    {
        if($project->survey_phase == 0){
            if(request('complete_qa')){
                 $project->update([
                    'status' => 3,
                    'survey_phase' => 1
                ]);
                }
            if(request('send_to_peer')){
                 $project->update([
                    'status' => 0
                ]);
            }
        }else if($project->survey_phase == 1){
            if(request('complete_qa')){
                $project->update([
                    'status' => 3,
                    'survey_phase' => 2
                ]);
            }
            if(request('send_to_peer')){
                $project->update([
                    'status' => 0
                ]);
            }
        }
        

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        //
    }
    protected function validateProject(){
        return request()->validate([
            'name' => ['unique:projects,name','required','min:3','max:255'],
            'osi' => ['unique:projects,osi','required','min:4','max:255']
        ]);
    }
}
