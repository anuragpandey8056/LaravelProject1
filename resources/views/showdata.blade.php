@extends('Layouts.master')

@section('content')
<section>
 <h1>show data</h1>


 <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">class</th>
      <th scope="col">mobile</th>
      <th scope="col">email</th>
      <th scope="col">Something</th>
      <th scope="col">Update</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
   @foreach($data as $data)
    <tr>
      
      <td>{{$data->id}}</td>
      <td>{{$data->name}}</td>
      <td>{{$data->class}}</td>
      <td>{{$data->mobile}}</td>
      <td>{{$data->email}}</td>
      <td>{{$data->idea}}</td>
      <td><button type="button" class="btn btn-warning"> <a href="{{url($data->id.'/edit')}}">Update</a></button></td>
      <td><button type="button" class="btn btn-danger"><a href="{{url($data->id.'/delete')}}">Delete</a></button></td>

      
    </tr>
    @endforeach
  </tbody>
</table>
</section>
@endsection