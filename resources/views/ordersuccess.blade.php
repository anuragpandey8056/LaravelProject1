<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="text-success">🎉 Order Successful!</h1>
            <p class="lead">Thank you for your purchase. Your payment has been received successfully.</p>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-light">
                <h4 class="mb-0">Order Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($order->status) }}</span></p>
                <p><strong>Total Amount:</strong> ₹{{ number_format($order->amount, 2) }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Items in Your Order</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Price (₹)</th>
                            <th>Quantity</th>
                            <th>Subtotal (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-primary">🛒 Continue Shopping</a>
        </div>

    </div>
</body>
</html>
