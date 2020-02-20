@extends('layouts.dashboard-layout')

@section('content')
    {{-- Edit Project --}}
<div class="col-md-6">
<div class="card">
	  <div class="card-header card-header-primary">
	    <h4 class="card-title ">Edit Project</h4>
	    <p class="card-category"></p>
	  </div>
	  <div class="card-body">
      <form method="post" action="/manage/{{ $project->name }}/update">
              @csrf
              @method('PATCH')
              @include('error')
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Project Name</label>
                        <input type="text" name="name" id="name" value="{{ $project->name }}" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="osi">OSI</label>
                        <input type="text" name="osi" id="osi" value="{{ $project->osi }}" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="proofer">Initial Proofer</label>
                        @if ($project->survey_phase == 1 && $project->status == 3)
                            <input type="hidden" name="proofer" value="{{ $project->proofer }}" class="form-control">
                            <p class="form-control">{{ $initial_proofer }}</p>
                        @else
                            <select name="proofer" id="proofer" class="form-control">
                              @foreach ($users->where('id', '!=', $project->owner)->where('id', '!=', $project->proofer2) as $user)
                                  <option value="{{ $user->id }}" {{ $project->proofer == $user->id ? 'selected':''}}>{{ $user->name }}</option>
                              @endforeach
                          </select>
                        @endif
                        
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="proofer2">Lockdown Proofer</label>
                        @if ($project->survey_phase == 2 && $project->status == 3)
                            <input type="hidden" name="proofer2" value="{{ $project->proofer2 }}" class="form-control">
                            <p class="form-control">{{ $lockdown_proofer }}</p>
                        @else
                            <select name="proofer2" id="proofer2" class="form-control">
                              @foreach ($users->where('id', '!=',$project->owner)->where('id', '!=',$project->proofer) as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                          </select>
                        @endif
                        
                      </div>
                  </div>
                  <div class="col-md-12">
                      <input type="submit" class="btn btn-sm btn-round btn-success" value="SAVE" />
                  </div>
              </div>
          </form>
	  </div>
	  </div>
	</div>
</div>
@endsection