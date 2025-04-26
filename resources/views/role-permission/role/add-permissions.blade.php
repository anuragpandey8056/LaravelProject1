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
    @if(session('status'))
        <div class="alert alert success">{{(session('status'))}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                    <h4> Role:{{$role->name}}
                        <a href="{{url ('roles/')}}" class="btn danger float-end">Back</a>
                    </h4>
            </div>
            <div class="card-body">

            <form action="{{ url('roles/' . $role->id . '/give-permissions') }}" method="POST">

                @csrf
                @method('PUT')
            <div class="mb-2">
                @error('permission')
                <span class="text-danger">{{$message}}</span>

                @enderror
                <label for="">Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                 <div class="col-md-3">
                    <label for="">

                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                    {{ in_array($permission->id, $rolepermission) ? 'checked' : '' }}>
                        {{$permission->name}}
                    </label>

                 </div>
                 @endforeach

                </div>
                <input type="text" value="{{$role->name}}" name="name" class="form-control"/>

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


</body>
</html>





















