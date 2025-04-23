@extends('Layouts.master')

@section('content')


{!! $aboutdetail->title !!}
<img src="{{ asset('storage/' . $aboutdetail->image) }}" class="pic" alt="About Image">


{!! $aboutdetail->content !!}


@endsection