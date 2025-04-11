@extends('Layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  

  <title>Document</title>
 
  
</head>
<body>
<section>
<h1 style="color:red,">Crud using Ajax</h1> 
</section>

<div>
          <table class="table table-dark table-striped justify-content-center">
            <thead>
              <tr>

   <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                <th scope="col">update</th>
                <th scope="col">Delete</th>

                
              </tr>
            </thead>
            <tbody id= 'empdata'>

              <tr>
               <td></td>
               <td></td>
               <td></td>
              
                <td>
                   <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
 
                   <a  href="">Update</a>
                   </button>
                </td>

                <td><button type="button" class="btn btn-danger ">
                  <a href="" >
                  Delete
                  </a>
                  
                </button></td>
              </tr>
             
            </tbody>
          </table>
      </div>


<section>


<div>
<button id= "newmodal" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mymodel">
  Add Product
</button> 

<!-- Modal -->
 <p id="respanel"> click on button open model</p>
<div class="modal fade" id="mymodel" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
<form  action="" method="POST" id="submitform">
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

      
      <input type="hidden" name="id" id="id" >
        
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
      
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Price</label>
        <input type="text" name="price" class="form-control" id="price">
      </div>


      <button type="submit" class="btn btn-primary ">Savedata</button>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div> 
    </div>
  </div>
</form>

</div>
</section>





<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  //update
  $(document).ready(function () {
    $('#newmodal').on('click',function(){
      $('#submitform')[0].reset();
      $('#id').val('');

    })

    //save data
    $('#submitform').on('submit', function (e) {
    e.preventDefault();
    var data = $(this).serialize();

    $.ajax({
        url: 'addproduct',
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            data: data
        },
        success: function(response) {
            $('#respanel').html(response);
            $('#submitform')[0].reset();
            $('#mymodel').modal('hide');

           
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');

            
            Swal.fire({
                title: 'Success!',
                text: 'Product has been added successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });

            fetchrecords();
        },
        error: function(xhr) {
            Swal.fire('Error!', 'Failed to save data.', 'error');
        }
    });
});

    //edit 
     
      $(document).on('click','.btn-warning',function(e){
          e.preventDefault();
          var id=$(this).val();
          //  alert(id)
          $.ajax({
            url:'editdata',
            type:'POST',
            data:{
          "_token":"{{csrf_token()}}",
          id:id
        },
        success:function(resp){
          $('#submitform')[0].reset();
          $('#id').val(resp.id);
          $('#name').val(resp.name);
          $('#price').val(resp.price);
          $('.btn-primary').text('update');
          $('#mymodel').modal('show');
          // fetchrecords();
        }

          });
      })

//delte
$(document).on('click', '.btn-danger', function(e) {
    e.preventDefault();
    var id = $(this).val();
Swal.fire({
        title: 'Are you sure?',
        text: "This record will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'deletedata',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'The record has been deleted.',
                        'success'
                    );
                    fetchrecords();
                    $('#respanel').html(response);
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong while deleting.',
                        'error'
                    );
                }
            });
     }
            });
            });




   //fetch
    function fetchrecords(){
     $.ajax({
      url:'fetchdata',
      type:'GET',
      success:function(resp){
        var tr="";
        for(var i=0;i<resp.length;i++){
          var id= resp[i].id;
          var name= resp[i].name;
          var price= resp[i].price;

          tr+='<tr>';


          tr+='<td>'+id+'</td>';
          tr+='<td>'+name+'</td>';
          tr+='<td>'+price+'</td>';
          tr+='<td><button type="button" class="btn btn-warning" value="'+id+'">Edit</button></td>';
          tr+='<td><button type="button" class="btn btn-danger" value="'+id+'">Delete</button></td>';

          tr+='</tr>';
         

        }
        $('#empdata').html(tr);
      }
     });
    }
    fetchrecords();

  });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection



















