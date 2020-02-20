@extends('layouts.dashboard-layout')

@section('content')

<!-- Modal -->
<form id="edit-comment-form" action="/item-comment" method="post">
	@csrf
	@method('PATCH')
	<input type="hidden" id="item_comment" name="item_comment">
<div class="modal fade" id="edit-comment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<textarea id="comment-textarea" style="width: 100%" name="comments"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

{{-- Project Details --}}
<div class="col-md-12">
	<div class="card">
		<div class="card-header card-header-primary">
			<h4 class="card-title ">Project Details</h4>
	    	{{-- <p class="card-category">Here is a the details of your project</p> --}}
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class="text-primary">
						<td>Project Name</td>
						<td>Jira Ticket</td>
						<td>Type of Survey</td>
						@if(auth()->id() == $project->owner)
						<td>Initial Reviewer</td>
						<td>Lockdown Reviewer</td>
						@endif
						@if(auth()->id() == $project->proofer || auth()->id() == $project->proofer2)
						<td>Owner</td>
						@endif
						<td>Checklist Type</td>
						<td>Survey Phase</td>
					</thead>
					<tbody>
						<tr>
							<td>{{ $project->name }}</td>
							<td>{{ $project->osi }}</td>
							<td>{{ $project->surveytype->type }}</td>
							@if(auth()->id() == $project->owner)
							<td>{{ $initial_proofer }}</td>
							<td>{{ $lockdown_proofer }}</td>
							@endif
							@if(auth()->id() == $project->proofer || auth()->id() == $project->proofer2)
							<td>{{ $project->project_owner->name }}</td>
							@endif
							<td>
								<select class="form-control" onchange="window.location=this.value">
								<option value="/project-checklist/{{ $project->name }}/confirmit/{{ $project->survey_phase == 0 ? 'initial':'lockdown' }}/{{ request('mode') }}" {{ strtolower($checklist_type) == 'confirmit' ? 'selected':''}}>Confirmit</option>
				            		<option value="/project-checklist/{{ $project->name }}/mailout-confirmit/{{ $project->survey_phase == 0 ? 'initial':'lockdown' }}/{{ request('mode') }}" {{strtolower($checklist_type) == 'mailout-confirmit' ? 'selected':''}}>Mailout-Confirmit</option>
				            		<option value="/project-checklist/{{ $project->name }}/mailout-worldmerge/{{ $project->urvey_phase == 0 ? 'initial':'lockdown' }}/{{ request('mode') }}" {{strtolower($checklist_type) == 'mailout-worldmerge' ? 'selected':''}}>Mailout-WorldMerge</option>
				            		<option value="/project-checklist/{{ $project->name }}/fc-open/{{ $project->survey_phase == 0 ? 'initial':'lockdown' }}/{{ request('mode') }}" {{strtolower($checklist_type) == 'fc-open' ? 'selected':''}}>FC-Open</option>
				            		<option value="/project-checklist/{{ $project->name }}/fc-login/{{ $project->survey_phase == 0 ? 'initial':'lockdown' }}/{{ request('mode') }}" {{strtolower($checklist_type) == 'fc-login' ? 'selected':''}}>FC-Login</option>
				            	</select>
							</td>
							<td>
								<select class="form-control" onchange="window.location=this.value">
									{{-- Shows for initial proofer --}}
									@if ( (($project->survey_phase == 1 && $project->status == 3) || ($project->survey_phase == 2 && $project->status == 3)) && $project->proofer == auth()->id())
										<option value="/project-checklist/{{ $project->name }}/{{ $checklist_type }}/initial/{{ request('mode') }}"{{ $survey_phase == 1 ? 'selected':'' }}>Initial</option>
									@endif

									{{-- Shows for lockdown proofer --}}
									@if( ($project->survey_phase == 2 && $project->status == 3) && $project->proofer2 == auth()->id())
										<option value="/project-checklist/{{ $project->name }}/{{ $checklist_type }}/lockdown/{{ request('mode') }}" {{ $survey_phase == 2 ? 'selected':'' }}>Lockdown</option>
									@endif

									{{-- Shows for the project owner --}}
									@if(($project->survey_phase == 2 && $project->status == 3) && $project->owner == auth()->id())
										<option value="/project-checklist/{{ $project->name }}/{{ $checklist_type }}/initial/{{ request('mode') }}"{{ $survey_phase == 1 ? 'selected':'' }}>Initial</option>
										<option value="/project-checklist/{{ $project->name }}/{{ $checklist_type }}/lockdown/{{ request('mode') }}" {{ $survey_phase == 2 ? 'selected':'' }}>Lockdown</option>
									@endif
									
								</select>
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
{{-- Checklist --}}
<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Checklist</h4>
	    {{-- <p class="card-category">Here is a the details of your project</p> --}}
	  </div>
	  <div class="card-body">
	    <div class="table-responsive">
	      <table class="table">
	        <tbody>
	        @foreach($checklist_category as $category)
	        <tr>
	        	<td colspan="30"><b>{{ $category->category_name }}</b></td>
	        </tr>
	        @foreach($project_checklist->where('category', $category->id) as $item)
	          <tr class='{{ $item->item_status == 2 ? "not-applicable":"" }}'>
			  <td colspan="15">{{ $item->checklist_item->description }}</td>
	            
	            <td style="text-align: right;">
	            	<form action="/project-checklist/{{ $item->id }}" method="post">
	            		@method('PATCH')
	            		@csrf
		            	<div class="form-check" style="margin-top: 0px">
			                <label class="form-check-label">

			                	@if($item->item_status == 0)
				                <input class="form-check-input" onchange="this.form.submit()" type="checkbox" name="item_status_ok"  value="1" >
				                @endif
			                	@if($item->item_status == 1)
				                <input class="form-check-input" onchange="this.form.submit()" type="checkbox" name="item_status_ok"  checked value="0" >
				                @endif
				                @if($item->item_status == 2)
				                <input type="checkbox" class="form-check-input" disabled>
				                @endif

				                <span class="form-check-sign">
				                	<span class="check"></span>
				                </span>
			                </label>
		                </div>
		            </form>
	            </td>

	            <td style="text-align: right;" colspan="10">
	            	<form action="/project-checklist/{{ $item->id }}" method="post">
	            		@method('PATCH')
	            		@csrf
	            	<div class="togglebutton">
			            <label>
				            <input type="checkbox" name="item_status_ok" onchange="this.form.submit()" value="2" {{ $item->item_status == 2 ? 'checked':'' }}>
				            <span class="toggle"></span>
			            </label>
		            </div>
		            </form>
	            </td>
	          </tr>
			  @if($item->item_status == 0)
			  
	          @foreach($comments_item->whereIn('project_checklist_id', $item->id) as $comment)
	          <tr style="text-indent: 50px;font-style: italic;">
	          	@if(request('item_comment') == $comment->id)
	          	<form action="/item-comment/{{$comment->id}}" method="post">
	          		@csrf
					@method('PATCH')
	          	<td colspan="">
	          		<input style="width: 100%" type="text" name="comments" value="{{ $comment->comments }}">
	          	</td>
	          	<td>
	          		<input type="submit" class="link" value="Save">
	          	</td>
	          	</form>
	          	@else
	          	<td colspan="">{{ $comment->comments }}</td>
	          	<td colspan="0">{{-- 
	          		<a class="edit-comment" data-id="{{$comment->id}}" data-toggle="modal" data-target="#edit-comment-modal" href="#{{$comment->id}}"><u>Edit</u></a> --}}
	          		<form>
	          			<input type="hidden" name="item_comment" value="{{$comment->id}}">
	          			<input type="submit" class="link" value="Edit">
	          		</form>
	          	</td>
	          	@endif
	          	
	          	<td colspan="0"  style="text-indent: 0px">
	          		<form action="/item-comment/{{$comment->id}}" method="post">
		          		@csrf
						@method('DELETE')

		          		<input type="hidden" name="item_comment" value="{{$comment->id}}">
	          			<input type="button" class="link" value="Delete">
		          	</form>
	          	</td>
	          </tr>
	          @endforeach
	          
	          	<form action="/item-comment" method="post">
	          		@csrf
	          		<input type="hidden" name="item_id" value="{{$item->id}}">
		        	<tr>
			          	<td colspan="10">
			          		<textarea class="" style="width: 100%" placeholder="Your comment..." name="comments" required></textarea>
			          	</td>
			          	<td colspan="10">
			          		<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Add Comment">
			          	</td>
			        </tr>
	      		</form>

	          @endif
	          @endforeach
	          @endforeach
	          <tr>
	          	<td colspan="30">

	          			@if(($project->peer->id == auth()->id() || $project->proofer2 == auth()->id()) && $project->status == 0 && request('mode') != 'view')
	          			<form action="/project/{{ $project->name }}" method="post">
		          			@method('PUT')
		          			@csrf
		          			<input class="btn btn-sm btn-success pull-right" type="submit" name="complete_qa" value="Complete QA">
		          		</form>
	          			@endif

	          			@if($project->owner == auth()->id() && request('mode') != 'view' && (($project->survey_phase == 0 && $project->status == 3) || ($project->survey_phase == 1 && $project->status == 3) || ($project->survey_phase == 2 && $project->status == 3)))
	          			<form action="/project/{{ $project->name }}" method="post">
		          			@method('PUT')
		          			@csrf
		          			<input class="btn btn-sm btn-success pull-right" type="submit" name="send_to_peer" value="Send to Peer">
		          		</form>
	          			@elseif($project->owner == auth()->id() && $project->status == 0 )
	          			<input class="btn btn-sm btn-default pull-right btn-disabled" type="button" value="Send to Peer">
						@endif
						  
	          	</td>
	          	{{-- @endif --}}
	          </tr>
	        </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>

{{-- Proofer Checklist --}}
@if((($project->survey_phase == 1 && $project->status == 3) || ($project->survey_phase == 2 && $project->status == 3)) && ($project->proofer != auth()->id() && $project->proofer2 != auth()->id()))
<div class="col-md-6">
	<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Proofer Checklist</h4>
	    {{-- <p class="card-category">Here is a the details of your project</p> --}}
	  </div>
	  <div class="card-body">
	  	 <div class="table-responsive">
	  	 	<table class="table">
	  	 		@foreach($checklist_category as $category)
	  	 		<tr>
	  	 			<td><b>{{ $category->category_name }}</b></td>
				</tr>
				   
	  	 		@foreach($proofer_checklist->where('category', $category->id)->where('user_id', (request('survey_phase') == 'initial' ? $project->proofer:$project->proofer2) ) as $proofer_item)
	  	 		<tr class="{{ $proofer_item->item_status == 2 ? 'not-applicable' : ($proofer_item->item_status == 1 ? 'item-ok' : 'item-with-comment') }}">
				   <td>{{ $proofer_item->checklist_item->description }}</td>
				</tr>

				@foreach ($comments_item->where('project_checklist_id', $proofer_item->id) as $comment)
					<tr style="text-indent:50px;font-style:italic;" class="text-danger">
						<td>{{ $comment->comments }}</td>
					</tr>
				@endforeach

				 @endforeach
				   
	  	 		@endforeach
	  	 	</table>
	  	 </div>
	  </div>
	</div>
</div>
@endif

{{-- Owners Checklist --}}
@if($project->proofer == auth()->id() || $project->proofer2 == auth()->id())
<div class="col-md-6">
	<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Owner's Checklist</h4>
	    {{-- <p class="card-category">Here is a the details of your project</p> --}}
	  </div>
	  <div class="card-body">
	  	 <div class="table-responsive">
	  	 	<table class="table">
	  	 		@foreach($checklist_category as $category)
	  	 		<tr>
	  	 			<td><b>{{ $category->category_name }}</b></td>
				</tr>
				   
	  	 		@foreach($proofer_checklist->where('category', $category->id)->where('user_id', $project->owner) as $proofer_item)
	  	 		<tr class="{{ $proofer_item->item_status == 2 ? 'not-applicable' : ($proofer_item->item_status == 1 ? 'item-ok' : 'item-with-comment') }}">
	  	 			<td>{{ $proofer_item->checklist_item->description }}</td>
				</tr>

				@foreach ($comments_item->where('project_checklist_id', $proofer_item->id) as $comment)
				<tr style="text-indent:50px;font-style:italic;" class="text-danger">
					<td>{{ $comment->comments }}</td>
				</tr>
				@endforeach

	  	 		@endforeach
	  	 		@endforeach
	  	 	</table>
	  	 </div>
	  </div>
	</div>
</div>
@endif

@endsection