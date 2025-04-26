<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<div class="container">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                    <h4> create User
                    <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>

                    </h4>
            </div>
            <div class="card-body">

            <form action="{{ url('users') }}" method="POST">

                @csrf
            <div class="mb-3">
                <label for=""> Name</label>
                <input type="text" name="name" class="form-control"/>

            </div>
            <div class="mb-3">
                <label for=""> Email</label>
                <input type="text" name="email" class="form-control"/>

            </div>
            <div class="mb-3">
                <label for=""> Password</label>
                <input type="password" name="password" class="form-control"/>


            </div>
            <div class="mb-3">
                <label for=""> Roles</label>
                <select name="roles[]" class="form-control"  id="" multiple>
                    <option value="">Select Roles</option>
                    @foreach($roles as $role)
                    <option value="{{$role}}">{{$role}}</option>
                     
                    @endforeach

                </select>

            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">save</button>
            </div>


            </form>

            </div>
        </div>
    </div>
</div>

</div>


</body>
</html>













