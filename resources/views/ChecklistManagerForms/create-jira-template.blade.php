@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/checklist-manager">Checlist Manager</a></li>
    <li class="breadcrumb-item" aria-current="page">Jira Template</li>
    <li class="breadcrumb-item" aria-current="page">Create</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title">Jira Template</h4>
            <p class="category">Create jira template</p>
        </div>
        <div class="card-body">
            @include('error')
            <form method="post" action="/jira-template">
                @csrf
                @method('POST')
                <div class="form-group bmd-form-group">
                    <label>Description</label>
                  <input type="text" class="form-control" name="description" value="{{ old('type') }}"/>
                </div>

                <button type="submit" class="btn btn-success">CREATE</button>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection