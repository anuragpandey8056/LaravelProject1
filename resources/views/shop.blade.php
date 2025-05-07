@extends('Layouts.master')

@section('content')
    <style>
        .container {
            padding: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            width: 260px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .card-price {
            color: #28a745;
            font-size: 16px;
            margin: 0;
        }

        .card button {
            margin-top: auto;
            padding: 10px 16px;
            background-color: rgb(16, 17, 19);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card button:hover {
            background-color: rgb(104, 95, 93);
        }

        .category-dropdown {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .category-dropdown select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        
        #loading {
            text-align: center;
            display: none;
            margin: 20px 0;
        }
    </style>

    {{-- Category Dropdown --}}
    <div class="category-dropdown">
        <select id="category-filter">
            <option value="">All Products</option>
            @foreach($category as $cat)
                <option value="{{ $cat->id }}">
                    {{ $cat->categoryname }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Display selected category --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <h3 id="category-title">All Products</h3>
    </div>
    
    {{-- Loading indicator --}}
    <div id="loading">
        <p>Loading products...</p>
    </div>

    {{-- Product cards --}}
    <div class="container" id="products-container">
        @foreach($product as $item)
            <div class="card">
                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                <div class="card-body">
                    <p class="card-title">{{ $item->name }}</p>
                    <p class="card-price">${{ number_format($item->price, 2) }}</p>
                    <button>Add to Cart</button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- AJAX Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category-filter').change(function() {
                const categoryId = $(this).val();
                
                // Show loading indicator
                $('#loading').show();
                
                $.ajax({
                    url: '/filter-products'
                    type: "GET",
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Update products container
                        $('#products-container').html(response.productsHtml);
                        
                        // Update category title
                        if (categoryId) {
                            $('#category-title').text('Showing products from category: ' + $('#category-filter option:selected').text());
                        } else {
                            $('#category-title').text('All Products');
                        }
                        
                        // Hide loading indicator
                        $('#loading').hide();
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                        $('#loading').hide();
                        
                    }
                });
            });
        });
    </script>
@endsection