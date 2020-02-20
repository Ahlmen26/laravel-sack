@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/checklist-manager">Checlist Manager</a></li>
    <li class="breadcrumb-item" aria-current="page">Checklist Category</li>
    <li class="breadcrumb-item" aria-current="page">Create</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header card-header-info">
            <h4 class="card-title">Checklist Category</h4>
            <p class="category">Create checklist category</p>
        </div>
        <div class="card-body">
            @include('error')
            <form method="post" action="/checklistcategory/{{ $checklistcategory->id }}">
                @csrf
                @method('PATCH')
                <div class="form-group bmd-form-group">
                    <label>Category Name</label>
                  <input type="text" class="form-control" name="category_name" value="{{ $checklistcategory->category_name }}"/>
                </div>

                <div class="form-group bmd-form-group">
                    <label>Checklist Types</label>
                    <select name="checklist_type" class="form-control" value="{{ old('checklist_type') }}">
                      @foreach ($checklisttypes as $checklisttype)
                        <option value="{{ $checklisttype->id }}" {{ $checklisttype->id == $checklistcategory->id ? 'selected': '' }}>{{ $checklisttype->type }}</option>
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