@extends('layouts.dashboard-layout')

@section('breadcrumbs')
<nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Manager Users</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="col-md-8">
    <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Users</h4>
                <p class="card-category">List of all users</p>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead class="text-primary">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
    
@endsection