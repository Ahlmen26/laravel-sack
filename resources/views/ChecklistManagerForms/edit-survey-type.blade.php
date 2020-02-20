@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/checklist-manager">Checlist Manager</a></li>
    <li class="breadcrumb-item" aria-current="page">Survey Type</li>
    <li class="breadcrumb-item" aria-current="page">Edit</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Survey Type</h4>
            <p class="category">Edit survey type</p>
        </div>
        <div class="card-body">
            @include('error')
            <form method="post" action="/surveytype/{{ $surveytype->id }}">
                @csrf
                @method('PATCH')
                <div class="form-group bmd-form-group">
                    <label>Type</label>
                    <input type="text" class="form-control" name="type" value="{{ $surveytype->type }}" />
                </div>

                <button type="submit" class="btn btn-info">UPDATE</button>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection