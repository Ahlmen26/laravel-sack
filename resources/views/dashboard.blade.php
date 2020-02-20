@extends('layouts.dashboard-layout')

@section('content')
{{-- Your projects --}}
<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Projects</h4>
	    <p class="card-category">Here is a list of your projects</p>
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table" style="text-align: center;">
	        <thead class=" text-primary">
	          <tr>
	            <th>Project Name</th>
	            <th>OSI</th>
	            <th>Status</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach($projects as $project)
	          <tr>
	          	@if($project->survey_phase == 1 && $project->status == 3)
	          	<td><a style="text-decoration: underline;font-weight: bold" href="project-checklist/{{ $project->name }}/confirmit/initial/view">{{$project->name}}</a></td>
	          	@elseif($project->survey_phase == 2 && $project->status == 3)
	          	<td><a style="text-decoration: underline;font-weight: bold" href="project-checklist/{{ $project->name }}/confirmit/lockdown/view">{{ $project->name }}</a></td>
	          	@else
	            <td>{{ $project->name }}</td>
	            @endif
	            <td>{{ $project->osi }}</td>
	            <td>
	            	@if($project->survey_phase == 0 && $project->status == 3 )
	            	<span class="badge badge-pill badge-secondary">NOT STARTED</span>
	            	@endif
	            	@if($project->survey_phase == 1 && $project->status == 0 || $project->survey_phase == 2 && $project->status == 0 || $project->survey_phase == 0 && $project->status == 0)
	            	<span class="badge badge-pill badge-warning">IN PROGRESS</span>
	            	@endif
	            	@if($project->survey_phase == 1 && $project->status == 3)
	            	<span class="badge badge-pill badge-success">Initial Completed</span>
	            	@endif
	            	@if($project->survey_phase == 2 && $project->status == 3)
	            	<span class="badge badge-pill badge-success">Lockdown Completed</span>
	            	@endif
	            </td>
	            <td>
					@if($project->survey_phase == 0 && $project->status == 3 )
					<a class="btn btn-primary btn-sm btn-round" href="project-checklist/{{ $project->name }}/confirmit/initial/review">Start Initial</a>
					@endif
					
					@if($project->survey_phase == 1 && $project->status == 3 && $project->proofer2 != 0)
					<a class="btn btn-primary btn-sm btn-round" href="project-checklist/{{ $project->name }}/confirmit/lockdown/review">Start Lockdown</a>
					@endif
					@if ($project->proofer2 == 0 && $project->survey_phase == 1)
					<a class="btn btn-primary btn-sm btn-round" href="/manage/{{ $project->name }}/edit">Lockdown Proofer</a>
					@endif
					{{-- @if(($project->survey_phase == 1 && $project->status == 3) || ($project->survey_phase == 2 && $project->status == 3))
					<div class="dropdown">

						<a class="btn btn-primary btn-sm btn-round dropdown-toggle dropdown-toggle-split" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							View Result
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="/result/{{ $project->name }}/initial" target="_blank">Initial</a>
							@if($project->survey_phase == 2 && $project->status == 3)
							<a class="dropdown-item" href="/result/{{ $project->name }}/lockdown" target="_blank">Lockdown</a>
							@endif
						</div>
						
					</div>
					@endif --}}

	            </td>
	          </tr>
	          @endforeach
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>

{{-- Assigned QAs --}}
<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Assigned QAs</h4>
	    <p class="card-category">Here is a list of the projects to be reviewed</p>
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table" style="text-align: center;">
	        <thead class=" text-primary">
	          <tr>
	            <th>Project Name</th>
	            <th>OSI</th>
	            <th>Status</th>
	            <th>Survey Phase</th>
	          </tr>
	        </thead>
	        <tbody>
			{{-- List of initial requests --}}
			@foreach($qa_request_initial->where('proofer', auth()->id())->where('survey_phase', 0) as $qa_request_initial)
	          <tr>
	          	<td>{{ $qa_request_initial->name }}</td>
	            <td>{{ $qa_request_initial->osi }}</td>
	            <td>
            		@if($qa_request_initial->status == 3)
	            	<span class="badge badge-pill badge-secondary">NOT STARTED</span>
	            	@endif
	            	@if($qa_request_initial->status == 0)
	            	<span class="badge badge-pill badge-warning">IN PROGRESS</span>
	            	@endif
	            	@if($qa_request_initial->status == 1)
	            	<span class="badge badge-pill badge-success">COMPLETED</span>
	            	@endif
	            </td>
	            <td>
	            	@if($qa_request_initial->survey_phase == 0)
	            	<a href="project-checklist/{{ $qa_request_initial->name }}/confirmit/initial/review">Start Initial</a>
	            	@endif
	            </td>
	          </tr>
	        @endforeach
			{{-- List of lockdown requests --}}
			@foreach($qa_request_lockdown->where('proofer2', auth()->id())->where('survey_phase', 1) as $qa_request_lockdown)
	          <tr>
	          	<td>{{ $qa_request_lockdown->name }}</td>
	            <td>{{ $qa_request_lockdown->osi }}</td>
	            <td>
            		@if($qa_request_lockdown->status == 3)
	            	<span class="badge badge-pill badge-secondary">NOT STARTED</span>
	            	@endif
	            	@if($qa_request_lockdown->status == 0)
	            	<span class="badge badge-pill badge-warning">IN PROGRESS</span>
	            	@endif
	            	@if($qa_request_lockdown->status == 1)
	            	<span class="badge badge-pill badge-success">COMPLETED</span>
	            	@endif
	            </td>
	            <td>
	            	@if($qa_request_lockdown->survey_phase == 1)
	            	<a href="project-checklist/{{ $qa_request_lockdown->name }}/confirmit/lockdown/review">Start Lockdown</a>
					@endif
	            </td>
	          </tr>
	        @endforeach
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>

{{-- Add Project --}}

<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Create Project</h4>
	    {{-- <p class="card-category">Here is a list of the projects to be reviewed</p> --}}
	  </div>
	  <div class="card-body">
	    <form action="/dashboard" method="post">
	    	@csrf
	    	@include('error')
	    	<div class="row">
	    		<div class="col-md-6">
	    			<div class="form-group bmd-form-group">
	                    <label class="bmd-label-floating">Project Name</label>
	                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
	                </div>
	    		</div>
	    		<div class="col-md-6">
	    			<div class="form-group bmd-form-group">
	                    <label class="bmd-label-floating">OSI</label>
	                    <input type="text" class="form-control" name="osi" value="{{ old('osi') }}" required>
	                </div>
	    		</div>
	    		<div class="col-md-6">
	    			<div class="form-group bmd-form-group">
	    				<label>Survey Type</label>
	                    <select class="form-control" name="survey_type" required placeholder="Survey Type">
		                    	@foreach($surveytype as $surveytype)
		                    	<option value="{{ $surveytype->id }}">{{ $surveytype->type }}</option>
	                    	@endforeach
	                    </select>
	                </div>
	    		</div>
	    		<div class="col-md-6">
	    			<div class="form-group bmd-form-group">
	    				<label>Proofer</label>
	                    <select class="form-control" name="proofer" required placeholder="Proofer">
		                    	@foreach($proofers->where('id','!=', auth()->id()) as $proofer)
		                    	<option value="{{ $proofer->id }}">{{ $proofer->name }}</option>
	                    		@endforeach
	                    </select>
	                </div>
	    		</div>
	    	</div>
			<hr/>
	    	<input class="btn btn-sm btn-success pull-right" type="submit" name="submit" value="Create">
	    </form>
	  </div>
	</div>
</div>


{{-- Completed QA --}}
<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Completed QAs</h4>
	    <p class="card-category">Here is a list of completed reviews</p>
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table" style="text-align: center;">
	        <thead class=" text-primary">
	          <tr>
	            <th>Project Name</th>
				<th>OSI</th>
				<th>Owner</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
			  {{-- List of completed initial QA --}}
	          @foreach($completed_qa_initial->where('proofer', auth()->id()) as $completed_qa_initial)
	          <tr>
	          	@if(($completed_qa_initial->survey_phase == 1 || $completed_qa_initial->survey_phase == 2) && ($completed_qa_initial->status == 0 || $completed_qa_initial->status == 3) && $completed_qa_initial->proofer == auth()->id())
	          	<td><a style="text-decoration: underline;font-weight: bold" href="project-checklist/{{ $completed_qa_initial->name }}/confirmit/initial/view">{{$completed_qa_initial->name}}</a></td>
	          	@elseif($completed_qa_initial->survey_phase == 2 && $completed_qa_initial->status == 3 && $completed_qa_initial->proofer2 == auth()->id())
	          	<td><a style="text-decoration: underline;font-weight: bold" href="project-checklist/{{ $completed_qa_initial->name }}/confirmit/lockdown/view">{{ $completed_qa_initial->name }}</a></td>
	          	@else
	            <td>{{ $completed_qa_initial->name }}</td>
	            @endif
				<td>{{ $completed_qa_initial->osi }}</td>
			  	<td>{{ $completed_qa_initial->project_owner->name }}</td>
	            <td>
					<div class="dropdown">

						<a class="btn btn-primary btn-sm btn-round dropdown-toggle dropdown-toggle-split" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							View Result
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="/result/{{ $completed_qa_initial->name }}/initial" target="_blank">Initial</a>
						</div>
						
					</div>

	            </td>
	          </tr>
	          @endforeach
			  {{-- List of completed lockdown QA --}}
	          @foreach($completed_qa_lockdown->where('proofer2', auth()->id())->where('status', 3) as $completed_qa_lockdown)
				<tr>
					@if($completed_qa_lockdown->survey_phase == 1 && ($completed_qa_lockdown->status == 0 || $completed_qa_lockdown->status == 3))
					<td><a style="text-decoration: underline;font-weight: bold"
							href="project-checklist/{{ $completed_qa_lockdown->name }}/confirmit/initial/view">{{$completed_qa_lockdown->name}}</a></td>
					@elseif($completed_qa_lockdown->survey_phase == 2 && $completed_qa_lockdown->status == 3)
					<td><a style="text-decoration: underline;font-weight: bold"
							href="project-checklist/{{ $completed_qa_lockdown->name }}/confirmit/lockdown/view">{{ $completed_qa_lockdown->name }}</a>
					</td>
					@else
					<td>{{ $completed_qa_lockdown->name }}</td>
					@endif
					<td>{{ $completed_qa_lockdown->osi }}</td>
					<td>{{ $completed_qa_lockdown->project_owner->name }}</td>
					<td>
						<div class="dropdown">
							<a class="btn btn-primary btn-sm btn-round dropdown-toggle dropdown-toggle-split" href="#" role="button"
								id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								View Result
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

								<a class="dropdown-item" href="/result/{{ $completed_qa_lockdown->name }}/lockdown" target="_blank">Lockdown</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>
@endsection