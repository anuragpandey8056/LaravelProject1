@extends('adminlayout.adminmaster')

@section('content')
<style>
    .admin-container {
        margin-left: 200px;
        padding: 30px;
        font-family: Arial, sans-serif;
    }

    h2, h3 {
        color: #333;
        margin-bottom: 20px;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    form input[type="text"], 
    form input[type="file"], 
    form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    form button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }

    table thead {
        background-color: #f5f5f5;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    table img {
        border-radius: 5px;
    }

    .action-buttons a, .action-buttons form {
        display: inline-block;
        margin-right: 5px;
    }

    .action-buttons button {
        background-color: #dc3545;
        color: white;
        padding: 5px 10px;
        font-size: 13px;
        border: none;
        border-radius: 3px;
    }

    .action-buttons button:hover {
        background-color: #bd2130;
    }
</style>

<div class="admin-container">

    <h2>Post Management</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <h3>{{ isset($edit) && $edit === true ? 'Edit Post' : 'Add New Post' }}</h3>

    <form method="POST" 
          action="{{ isset($edit) && $edit ? route('blogs.update', $post->id) : route('blogs.store') }}" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($edit) && $edit)
            @method('PUT')
        @endif

        <input type="text" id="editor2"  name="title" placeholder="Post Title" 
               value="{{ old('title', $post->title ?? '') }}">

        <textarea name="content" id="editor">{{ old('content', $post->content ?? '') }}</textarea>

        <input type="file" name="image">
        @if(isset($post) && $post->image)
            <div style="margin-top: 10px;">
                <img src="{{ asset('storage/' . $post->image) }}" width="100">
            </div>
        @endif

        <button type="submit">
            {{ isset($edit) && $edit ? 'Update' : 'Save' }}
        </button>
    </form>

    <h3>All Posts</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $item)
                <tr>
                <td>{!! $item->title !!}</td>

                    <td>{!! Str::limit($item->content, 100) !!}</td>

                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" width="60">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('adminblog', ['edit' => true, 'id' => $item->id]) }}">Edit</a>

                        <a href="/destory/{{ $item->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">
                                <i class="fas fa-trash-alt me-1"></i>Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

{{-- Jodit Editor --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3.24.5/build/jodit.min.css">
<script src="https://cdn.jsdelivr.net/npm/jodit@3.24.5/build/jodit.min.js"></script>
<script>
    const editor = new Jodit('#editor');
    const editor2 = new Jodit('#editor2');
</script>
@endsection
