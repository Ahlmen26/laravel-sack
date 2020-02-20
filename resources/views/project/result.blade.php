@extends('layouts.result-layout')

@section('content')
  
{{-- Proofer --}}
<div class="row">
  <div class="col-md-8 offset-2">
      <div class="card">
          <div class="card-header card-header-icon card-header-rose">
            <div class="card-icon">
              <i class="material-icons">description</i> 
            </div>
          </div>
          <div class="card-body">
          <h4 class="card-title text-center">{{ strtoupper(request('phase')) }}</h4>
              <hr/>
              <div style="padding:0.5em;box-shadow:0px 0px 2px gray inset;border-radius:3px">
                <p>
                {panel:title=For GRC Internal QA Purposes Only - {{ ucfirst(request('phase')) }} - Feedback}
                </p>
  
                <p>
                  Hi, {{ $project->project_owner->name }}
                </p>

                @foreach ($jira_templates as $jira_template)                
                  <p>
                    {{ $jira_template->description }}<br/>

                    @if (count($project_checklist->where('jira_temp_id', $jira_template->id)->where('item_status', 0)) > 0)
                    @foreach ($project_checklist->where('jira_temp_id', $jira_template->id)->where('item_status', 0) as $item)
                            @if (count($comments->where('project_checklist_id', $item->id)) > 0)
                                @foreach ($comments->where('project_checklist_id', $item->id) as $comment)
                                  * {{ $comment->comments }} <br/>
                                @endforeach
                            @else
                                * No issues found
                            @endif
                            
                    @endforeach
                    @else
                    * No issues found
                    @endif
                  </p>
                @endforeach

                <p>
                  I have updated the QA checklists. Let me know if you have questions.
                </p>
  
                <p>
                  Thanks.
                </p>

              </div>
          </div>
      </div>
  </div>
</div>

@endsection