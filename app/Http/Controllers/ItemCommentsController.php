<?php

namespace App\Http\Controllers;

use App\ProjectItemComments;
use Illuminate\Http\Request;

class ItemCommentsController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        ProjectItemComments::create([
            'project_checklist_id' => request('item_id'),
            'comments' => request('comments')
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectItemComments  $projectItemComments
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectItemComments $projectItemComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectItemComments  $projectItemComments
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectItemComments $projectItemComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectItemComments  $projectItemComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectItemComments $projectItemComments)
    {
        //
        $projectItemComments->where('id', request('item_comment'))->update([
            'comments' => request('comments')
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectItemComments  $projectItemComments
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectItemComments $projectItemComments)
    {
        //
        $projectItemComments->destroy(request('item_comment'));

        return redirect()->back();
    }
}
