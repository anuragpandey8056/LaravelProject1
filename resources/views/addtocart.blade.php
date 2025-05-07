<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-body img {
      width: 65px;
      height: auto;
    }
    .btn-stripe {
      background-color: #6772e5;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
    }
    .btn-stripe:hover {
      background-color: #5469d4;
    }
  </style>
</head>
<body>

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <!-- Display any flash messages -->
            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <div class="row">

              <!-- Cart Items Column -->
              <div class="col-lg-7">
                <a href="{{ url()->previous() }}" class="text-decoration-none text-dark mb-3 d-inline-block">
                  <i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping
                </a>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have {{ count($cart ?? []) }} item(s) in your cart</p>
                  </div>
                </div>

                @if(!empty($cart) && count($cart) > 0)
                  @php $total = 0; @endphp
                  @foreach($cart as $id => $item)
                    @php 
                      $subtotal = $item['price'] * $item['quantity']; 
                      $total += $subtotal;
                    @endphp
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-row align-items-center">
                            <div>
                              <img src="{{ $item['image'] }}" class="img-fluid rounded-3" alt="{{ $item['name'] }}">
                            </div>
                            <div class="ms-3">
                              <h5>{{ $item['name'] }}</h5>
                              <p class="small mb-0">{{ $item['description'] ?? '' }}</p>
                            </div>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                            <div style="width: 50px;">
                              <form action="{{ url('update-cart', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                  class="form-control form-control-sm" 
                                  onchange="this.form.submit()">
                              </form>
                            </div>
                            <div style="width: 80px;" class="ms-2">
                              <h5 class="mb-0">₹{{ number_format($item['price'], 2) }}</h5>
                            </div>
                            <a href="{{ url('remove-cart', $id) }}" style="color: #cecece;" class="ms-2">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="alert alert-info">Your cart is empty.</div>
                @endif

              </div>

              <!-- Order Summary Column -->
              <div class="col-lg-5">
                <div class="card bg-secondary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Order Summary</h5>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                        class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                    </div>

                    <hr class="my-4">

                    @if(!empty($cart) && count($cart) > 0)
                      @php 
                        $subtotal = $total;
                        $shipping = 20.00;
                        $totalWithTax = $subtotal + $shipping;
                      @endphp

                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">₹{{ number_format($subtotal, 2) }}</p>
                      </div>

                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Shipping</p>
                        <p class="mb-2">₹{{ number_format($shipping, 2) }}</p>
                      </div>

                      <div class="d-flex justify-content-between mb-4">
                        <p class="mb-2">Total (Incl. taxes)</p>
                        <p class="mb-2">₹{{ number_format($totalWithTax, 2) }}</p>
                      </div>

                      <!-- Stripe Payment Button -->
                      <form action="{{ url('/stripe/checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $totalWithTax }}">
                        <button type="submit" class="btn-stripe">
                          Pay with Stripe
                        </button>
                      </form>
                    @else
                      <div class="alert alert-info text-dark">Add items to cart to checkout</div>
                    @endif
                  </div>
                </div>
              </div>

            </div> <!-- row end -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>