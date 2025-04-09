@extends('Layouts.master')

@section('content')

<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<section>
  


<div>
  <form action="{{ url($data->id.'/update') }}" method="POST">
    @csrf
    <div class="alert alert-success">{{session('status')}}</div>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" value="{{$data->name}}" name="name" class="form-control" id="name">
    @error('name')<span class="text-danger">{{$message}}</span>@enderror

  </div>

  <div class="mb-3">
    <label for="class" class="form-label">Class</label>
    <input type="text" name="class" value="{{$data->class}}" class="form-control" id="class">
    @error('class')<span class="text-danger">{{$message}}</span>@enderror

  </div>

  <div class="mb-3">
    <label for="mobile" class="form-label">Mobile</label>
    <input type="number" name="mobile" value="{{$data->mobile}}" class="form-control" id="mobile">
    @error('mobile')<span class="text-danger">{{$message}}</span>@enderror

  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" value="{{$data->email}}" class="form-control" id="email">
    @error('email')<span class="text-danger">{{$message}}</span>@enderror

  </div>

  <div class="mb-3">
    <label for="idea" class="form-label">What do you have in mind?</label>
    <input type="text" name="idea" value="{{$data->idea}}" class="form-control" id="idea">
    @error('idea')<span class="text-danger">{{$message}}</span>@enderror

  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>








</div>



      

@endsection