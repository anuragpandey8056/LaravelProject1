@extends('Layouts.master')

@section('content')
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
<style>
  .btn-outline-light:hover {
    background-color: #ffffff;
    color: #000000;
    transform: scale(1.05);
    transition: all 0.3s ease;
  }




  .btn-black {
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.25rem;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .btn-black:hover {
    background-color: #333;
    color: #fff;
    transform: scale(1.03);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
  }
  <style>
  .nav-link i {
    transition: transform 0.3s, color 0.3s;
    color: #343a40; /* Default icon color */
  }

  .nav-link:hover i {
    color: #007bff; /* Hover color: blue (Bootstrap primary) */
    transform: scale(1.2); /* Slight zoom effect */
  }
</style>



</style>
</head>

<!-- <img src="{{asset($activeHeroes->url)}}" width="100%" height="600px" alt="">                   
<p>{{ $activeHeroes->description }}</p> -->


<!-- Hero Section -->
<section class="bg-image" style="background-image: url('{{ asset($activeHeroes->url)}}'); height: 100vh;">
  <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); height: 100%;">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div style="width: 90%; margin: 0 auto;">
        <div class="text-white text-center px-4">
          <h1 class="mb-4 display-4 fw-bold">Welcome to Our World</h1>
         <marquee> <p class="lead mb-4">
            {{$activeHeroes->description}}
          </p>
</marquee>
          <a class="btn btn-outline-light btn-lg" href="#learn-more" role="button">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>


<section>
<!-- Add Font Awesome CDN (if not already added) -->

<nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
  <div class="container-fluid justify-content-around">
    </a>

    <!-- Fashion -->
    <a class="nav-link text-dark" title="Fashion"   onclick="handleFashionClick()">
      <i class="fas fa-tshirt fa-lg"></i>
    </a>

    <!-- Electronics -->
    <a class="nav-link text-dark"  title="Electronics" onclick="handleelectronicsClick()">
      <i class="fas fa-laptop fa-lg"></i>
    </a>

    <!-- Beauty -->
    <a class="nav-link text-dark"  title="Beauty" onclick="handlebeautyClick()">
      <i class="fas fa-magic fa-lg"></i>
    </a>

    <!-- Grocery -->
    <a class="nav-link text-dark" title="Grocery" onclick="handlegroceryClick()">
      <i class="fas fa-apple-alt fa-lg"></i>
    </a>

    <!-- Stationary -->

    <a class="nav-link text-dark"  title="Stationary" onclick="handlestationaryClick()">
  <i class="fas fa-pencil-alt fa-lg"></i>
</a>
   

  </div>
</nav>

</section>
<div id="beauty" style="display:none">@include('beauty')</div>
<div id="electronics" style="display:none">@include('electronics')</div>
<div id="fashion" style="display:none">@include('fashion')</div>
<div id="Stationary" style="display:none">@include('stationary')</div>
<div id="grocery"  style="display:none">@include('grocery')</div>

<section>



<script>


  function showOnly(sectionId) {
    const sections = ["fashion", "electronics", "beauty", "grocery", "Stationary"];

    sections.forEach(id => {
      const el = document.getElementById(id);
      if (el) {
        el.style.display = (id === sectionId) ? "block" : "none";
      }
    });
  }

  function handleFashionClick() {
    // alert('Fashion');
    showOnly("fashion");
  }

  function handleelectronicsClick() {
    // alert('Electronics');
    showOnly("electronics");
  }

  function handlebeautyClick() {
    // alert('Beauty');
    showOnly("beauty");
  }

  function handlegroceryClick() {
    // alert('Grocery');
    showOnly("grocery");
  }

  function handlestationaryClick() {
    // alert('Stationary');
    showOnly("Stationary");
  }
</script>


















 
@endsection