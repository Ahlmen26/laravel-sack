<?php

namespace App\Http\Controllers;

use App\JiraTemplate;
use Illuminate\Http\Request;

class JiraTemplateController extends Controller
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
        //
        return view('checklistmanagerforms.create-jira-template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JiraTemplate $jiraTemplate)
    {
        //
        $request->validate([
            'description' => 'required'
        ]);
        $jiraTemplate->description = $request->description;

        $jiraTemplate->save();

        return redirect('checklist-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JiraTemplate  $jiraTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(JiraTemplate $jiraTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JiraTemplate  $jiraTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(JiraTemplate $jiraTemplate)
    {
        //
        return view('checklistmanagerforms.edit-jira-template', [
            'jira_template' => $jiraTemplate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JiraTemplate  $jiraTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JiraTemplate $jiraTemplate)
    {
        //
        $request->validate([
            'description' => 'required'
        ]);

        $jiraTemplate->description = $request->description;

        $jiraTemplate->update();

        return redirect('checklist-manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JiraTemplate  $jiraTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(JiraTemplate $jiraTemplate)
    {
        //
    }
}
