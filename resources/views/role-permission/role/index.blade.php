<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
@extends('adminlayout.adminmaster')

@section('content')

<div class="container">

<div class="row">
    <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert success">{{(session('status'))}}</div>
        @endif

        <div class="card mt-3">
            <div class="card-header">
                    <h4>Roles
                        <a href="{{url('roles/create')}}" class="btn btn-primary float-end">Add Role</a>
                    </h4>
            </div>
            <div class="card-body">

            <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th >Id</th>
                    <th >Name</th>
                    <th >Action</th>
                  
                </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                      <td>{{$role->id}}</td>
                      <td>{{$role->name}}</td>
                      <td>
                        <a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-success">Add / Edit Role Permission</a>
                        <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-success">Edit</a>

                        <a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-danger">Delete</a>

                      </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>

</div>

@endsection
</body>
</html>





