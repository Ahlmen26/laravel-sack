@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Checklist Manager</li>
  </ol>
</nav>
@endsection

@section('content')

    {{-- Jira Template --}}
    <div class="col-md-3">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Jira Template</h4>
                <p class="card-category">List of descriptions</p>
            </div>

            <div class="card-body">
               <div class="table-responsive table-full-width" style="max-height: 350px">
                   <table class="table">
                       <thead class="text-primary">
                           <th width="100%">Name</th>
                           <th>Action</th>
                       </thead>
                       <tbody>

                        {{-- Loop list of survey types --}}
                        @foreach ($jira_templates as $jira_template)
                        <tr>
                            <td>{{ $jira_template->description }}</td>
                            <td>
                                <a href="/jira-template/{{ $jira_template->id }}/edit" class="badge badge-info"><i style="font-size: 0.8rem" class="material-icons">edit</i> Edit</a>
                            </td>
                        </tr>
                        @endforeach

                       </tbody>
                   </table>
               </div>
               <hr/>
               <div>
                   <a href="/jira-template/create" class="btn btn-sm btn-success">Add</a>
               </div>
            </div>
        </div>

    </div>

    {{-- Survey types --}}
    <div class="col-md-3">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Survey Types</h4>
                <p class="card-category">List of survey types</p>
            </div>

            <div class="card-body">
               <div class="table-responsive table-full-width" style="max-height: 350px">
                   <table class="table">
                       <thead class="text-primary">
                           <th width="100%">Name</th>
                           <th>Action</th>
                       </thead>
                       <tbody>

                        {{-- Loop list of survey types --}}
                           @foreach ($surveyTypes as $surveyType)
                           <tr>
                               <td>{{ $surveyType->type }}</td>
                               <td>
                                    <a href="/surveytype/{{ $surveyType->id }}/edit" class="badge badge-info"><i style="font-size: 0.8rem" class="material-icons">edit</i> Edit</a>
                               </td>
                           </tr>
                           @endforeach

                       </tbody>
                   </table>
               </div>
               <hr/>
               <div>
                   <a href="/surveytype/create" class="btn btn-sm btn-success">Add</a>
               </div>
            </div>
        </div>

    </div>

    {{-- Checklist Types --}}
    <div class="col-md-3">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Checklist Types</h4>
                <p class="card-category">List of checklist types</p>
            </div>
            <div class="card-body">
               <div class="table-responsive table-full-width" style="max-height: 350px">
                   <table class="table">
                       <thead class="text-primary">
                           <th width="80%">Name</th>
                           <th>Action</th>
                       </thead>
                       <tbody>
                           {{-- Loop list of checklist types --}}
                           @foreach ($checklistTypes as $checklistType)
                           <tr>
                               <td>{{ $checklistType->type }}</td>
                                <td>
                                        <a href="/checklisttype/{{$checklistType->id}}/edit" class="badge badge-info"><i style="font-size: 0.8rem" class="material-icons">edit</i> EDIT</a>
                                </td>
                           </tr>
                           @endforeach

                       </tbody>
                   </table>
               </div>
                <hr/>
                <div>
                <a href="/checklisttype/create" class="btn btn-sm btn-success">Add</a>
                </div>
            </div>

        </div>

    </div>
    {{-- Checklist Categories --}}
    <div class="col-md-3">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Checklist Categories</h4>
                <p class="card-category">List of checklist categories</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table-full-width" style="max-height: 350px">
                   <table class="table">
                       <thead class="text-primary">
                           <th width="50%">Name</th>
                           <th width="30%">Checklist Type</th>
                           <th width="20%">Action</th>
                       </thead>
                       <tbody>
                           {{-- Loop list of checklist categories --}}
                           @foreach ($checklistCategories as $checklistCategory)
                               
                           <tr>
                               <td>{{ $checklistCategory->category_name }}</td>
                               <td>{{ $checklistCategory->type }}</td>
                               <td>
                                    <a href="checklistcategory/{{ $checklistCategory->id }}/edit" class="badge badge-info badge-sm"><i style="font-size: 0.8rem" class="material-icons">edit</i> EDIT</a>
                               </td>
                           </tr>

                           @endforeach

                       </tbody>
                   </table>
                </div>
                <hr/>
                <div>
                <a href="/checklistcategory/create" class="btn btn-sm btn-success">Add</a>
                </div>
            </div>
        </div>

    </div>

    {{-- Checklists --}}

    <div class="col-md-12">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Checklists</h4>
                <p class="card-category">List of checklist items</p>
            </div>
            <div class="card-body">

                <div class="table-responsive" style="max-height: 350px">
                    <table class="table table-striped">
                        <thead class="text-primary">
                            <th width="30%">Description</th>
                            <th width="20%">Category</th>
                            <th width="10%">Checklist Type</th>
                            <th width="10%">Survey Type</th>
                            <th width="20%">Jira Category</th>
                            <th width="10%">Action</th>
                        </thead>
                        <tbody>
                            {{-- Loop checklist table --}}
                            @foreach ($checklists as $checklist)
                                
                            <tr>
                                <td>{{ $checklist->description }}</td>
                                <td>{{ $checklist->category_item->category_name }}</td>
                                <td>{{ $checklist->checklistType->type }}</td>
                                <td>{{ $checklist->surveyType->type }}</td>
                                <td>{{ $checklist->jira_category->description }}</td>
                                <td><a href="checklist-manager/{{ $checklist->id }}/edit" class="badge badge-info badge-sm"><i style="font-size: 0.8rem" class="material-icons">edit</i> EDIT</a></td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr/>
                <div>
                    <a href="/checklist-manager/create" class="btn btn-sm btn-success">Add</a>
                </div>
            
            </div>
        </div>

    </div>
@endsection