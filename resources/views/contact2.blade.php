@extends('Layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>Document</title>
  
</head>
<body>
<section>
<h1 style="color:red,">Crud using Ajax</h1>
</section>
<div>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
  Add Product
</button>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
<form action="{{route('addproduct')}}" method="POST" id="addproductform">
@csrf
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="errMsgContainer">
      </div> 
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
      
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Price</label>
        <input type="text" name="price" class="form-control" id="price">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary ">Save product</button>
      </div> 
    </div>
  </div>
</form>
</div>
</div>













<section id="contact2">

      <div>
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                <th scope="col">update</th>
                <th scope="col">Delete</th>

                
              </tr>
            </thead>
            <tbody>
              @foreach($data as $data)
              <tr>
             
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->price}}</td>
                <td>
                   <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
 
                   <a  href="">Update</a>
                   </button>
                </td>

                <td><button type="button" class="btn btn-danger ">
                  <a href="javascript:void(0)"
                  onclick="deleteproduct({{$data->id}})" >
                  Delete
                  </a>
                  
                </button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  
    </section>

<script type="text/javascript">
  function deleteproduct(id){
    if(confirm("are u sure u want to delte this "))
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    $.ajax({
      url:'deleteajax/' +id,
      type:'DELETE',
      success:function(result){

      }
    })
  }
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>
@endsection



















