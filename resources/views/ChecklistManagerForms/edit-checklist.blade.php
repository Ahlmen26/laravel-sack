@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/checklist-manager">Checlist Manager</a></li>
    <li class="breadcrumb-item" aria-current="page">Checklist</li>
    <li class="breadcrumb-item" aria-current="page">Edit</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-6">
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Checklist</h4>
            <p class="category">Edit checklist</p>
        </div>
        <div class="card-body">
            @include('error')
            <form method="post" action="/checklist-manager/{{ $checklist->id }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="" class="form-control" name="description" id="description">{{ $checklist->description }}</textarea>
                </div>

                {{-- Categories --}}
                <div class="form-group">
                  <label for="category">Category</label>
                  <select name="category" id="category" class="form-control">

                    @foreach ($categories as $category)                    
                      <option value="{{ $category->id }}" {{ $checklist->category == $category->id ? 'selected':'' }}>{{ $category->category_name }}</option>
                    @endforeach

                  </select>
                </div>

                {{-- Checklist Type --}}
                <div class="form-group">
                  <label for="checklist_type">Checklist Type</label>
                  <select name="checklist_type" id="checklist_type" class="form-control">

                    @foreach ($checklist_types as $checklist_type)                    
                      <option value="{{ $checklist_type->id }}" {{ $checklist->checklist_type == $checklist_type->id ? 'selected':'' }}>{{ $checklist_type->type }}</option>
                    @endforeach

                  </select>
                </div>

                {{-- Survey Type --}}
                <div class="form-group">
                  <label for="survey_type">Survey Type</label>
                  <select name="survey_type" id="survey_type" class="form-control">

                    @foreach ($survey_types as $survey_type)                    
                      <option value="{{ $survey_type->id }}" {{ $checklist->survey_type == $survey_type->id ? 'selected':'' }}>{{ $survey_type->type }}</option>
                    @endforeach

                  </select>
                </div>

                {{-- Jira Category --}}
                <div class="form-group">
                  <label for="jira_temp_id">Jira Category</label>
                  <select name="jira_temp_id" id="jira_temp_id" class="form-control">

                    @foreach ($jira_templates as $jira_template)                    
                      <option value="{{ $jira_template->id }}" {{ $checklist->jira_temp_id == $jira_template->id ? 'selected':'' }}>{{ $jira_template->description }}</option>
                    @endforeach

                  </select>
                </div>

                <button type="submit" class="btn btn-info">UPDATE</button>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection