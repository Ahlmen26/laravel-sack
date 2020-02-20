@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/checklist-manager">Checlist Manager</a></li>
    <li class="breadcrumb-item" aria-current="page">Checklist Type</li>
    <li class="breadcrumb-item" aria-current="page">Create</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Checklist Type</h4>
            <p class="category">Edit checklist type</p>
        </div>
        <div class="card-body">
            @include('error')
            <form method="post" action="/checklisttype/{{ $checklisttype->id }}">
                @csrf
                @method('PUT')
                <div class="form-group bmd-form-group">
                    <label>Type</label>
                  <input type="text" class="form-control" name="type" value="{{ $checklisttype->type }}"/>
                </div>

                <button type="submit" class="btn btn-info">UPDATE</button>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection