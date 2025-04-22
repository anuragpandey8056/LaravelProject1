<!-- <h1>electronics</h1> -->


@php
$x = "Electronics";
@endphp

<div class="container py-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">

    @foreach($products as $product)
      @if ($x == $product->category->categoryname)
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="{{ $product->image }}" class="card-img-top" width="200px" alt="{{ $product->name }}">
            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <h6 class="text-success mb-2">${{ $product->price }}</h6>
              <p class="card-text">{{ $product->description ?? 'No description available.' }}</p>
            </div>
            <div class="card-footer bg-transparent border-0">
            <a href="{{route('addcart',['id'=>$product->id])}}" class="btn btn-black w-100">Add to Cart</a>

            </div>
          </div>
        </div>
      @endif
    @endforeach

  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
