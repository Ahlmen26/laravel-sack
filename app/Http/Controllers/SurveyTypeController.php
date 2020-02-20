<?php

namespace App\Http\Controllers;

use App\SurveyType;
use Illuminate\Http\Request;

class SurveyTypeController extends Controller
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
        return view('checklistmanagerforms.create-survey-type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store data
        $attributes = $this->validateType();

        SurveyType::create($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SurveyType  $surveyType
     * @return \Illuminate\Http\Response
     */
    public function show(SurveyType $surveyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SurveyType  $surveyType
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveyType $surveytype)
    {
        //
        return view('checklistmanagerforms.edit-survey-type', [
            'surveytype' => $surveytype
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SurveyType  $surveyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurveyType $surveytype)
    {
        // Validate title
        $attributes = $this->validateType();

        // Update after validation
        $surveytype->update($attributes);

        return redirect('checklist-manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SurveyType  $surveyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveyType $surveyType)
    {
        //
    }
    public function validateType(){
        return request()->validate([
            'type' => 'required'
        ]);
    }
}
