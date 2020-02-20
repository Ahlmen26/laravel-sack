@extends('layouts.dashboard-layout')

@section('content')
{{-- Project Details --}}

<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Project Details</h4>
	    <p class="card-category">Here is a the details of your project</p>
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table">
	        <thead class=" text-primary">
	          <tr>
	            <th>Project Name</th>
	            <th>OSI</th>
	            <th>Initial</th>
	            <th>Lockdown</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
			@foreach($projects as $project)
			<form method="post" action="/manage/{{ $project->name }}/edit">
				@csrf
				@method('GET')
	          <tr>
	            <td>{{ $project->name }}</td>
	            <td>{{ $project->osi }}</td>
	            <td>{{ $users->where('id', $project->proofer)->value('name') }}</td>
	            <td>{{ $users->where('id', $project->proofer2)->value('name') }}</td>
	            <td>
				<input type="submit" class="btn btn-sm btn-info btn-round" title="Edit Project" value="EDIT" />
				</td>
			  </tr>
			</form>
	        @endforeach
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>
@endsection