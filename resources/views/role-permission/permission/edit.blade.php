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
        <div class="card">
            <div class="card-header">
                    <h4> Edit Permissions 
                        <a href="{{url ('permission/')}}" class="btn danger float-end">Back</a>
                    </h4>
            </div>
            <div class="card-body">

            <form action="{{url ('permission/'.$permission->id)}}" method="POST">
                @csrf
                @method('PUT')
            <div class="mb-3">
                <label for="">Permission Name</label>
                <input type="text" value="{{$permission->name}}" name="name" class="form-control"/>

            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>


            </form>

            </div>
        </div>
    </div>
</div>

</div>

@endsection
</body>
</html>





















