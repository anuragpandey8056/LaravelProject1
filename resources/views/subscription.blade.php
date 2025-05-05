<!-- resources/views/subscription.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pricing Plans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom,rgb(64, 65, 65),rgb(44, 39, 46));
            min-height: 100vh;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        .pricing-card {
            background-color: rgba(17, 24, 39, 0.5);
            border-radius: 0.75rem;
            padding: 2rem !important;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Card hover animation */
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background-color: rgba(17, 24, 39, 0.7);
        }
        
        /* Popular plan highlight animation */
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.4);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(236, 72, 153, 0);
            }
        }
        
        .popular-plan {
            animation: pulse 2s infinite;
        }
        
        .check-circle {
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .basic-check {
            background-color: rgba(45, 212, 191, 0.2);
            color: rgb(45, 212, 191);
        }
        
        .premium-check {
            background-color: rgba(236, 72, 153, 0.2);
            color: rgb(236, 72, 153);
        }
        
        .enterprise-check {
            background-color: rgba(59, 130, 246, 0.2);
            color: rgb(59, 130, 246);
        }
        
        .pricing-card:hover .check-circle {
            transform: scale(1.2);
        }
        
        .popular-badge {
            background-color: rgb(236, 72, 153);
            border-radius: 9999px;
            padding: 0.25rem 1rem;
            font-size: 0.75rem;
            position: absolute;
            top: -0.75rem;
            left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s ease;
        }
        
        /* Button animations */
        .action-button {
            padding: 0.75rem 1rem !important;
            font-size: 1.1rem !important;
            margin: 1.5rem 0 !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .action-button:hover {
            transform: translateY(-3px);
        }
        
        .action-button::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s ease;
        }
        
        .action-button:hover::after {
            left: 100%;
        }
        
        /* Make the container narrower to make cards appear larger */
        .pricing-container {
            max-width: 1000px !important;
            margin: 0 auto;
        }
        
        /* Increase spacing between elements */
        .card-title {
            font-size: 1.5rem !important;
            margin-bottom: 1rem !important;
            transition: all 0.3s ease;
        }
        
        .pricing-card:hover .card-title {
            transform: scale(1.05);
        }
        
        .card-description {
            font-size: 1rem !important;
            margin-bottom: 1.5rem !important;
            line-height: 1.5;
        }
        
        .price {
            font-size: 3.5rem !important;
            margin-bottom: 1.5rem !important;
            transition: all 0.3s ease;
        }
        
        .pricing-card:hover .price {
            transform: scale(1.1);
        }
        
        .price-currency {
            font-size: 1.5rem !important;
        }
        
        .feature-list {
            margin-top: 2rem !important;
        }
        
        .feature-item {
            font-size: 1rem !important;
            margin-bottom: 1rem !important;
            transition: all 0.2s ease;
        }
        
        .feature-item:hover {
            transform: translateX(5px);
        }
        
        /* Navigation link hover effect */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: white;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Button styling */
        .btn-get-started {
            width: 100%;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }
        
        /* Make modal text dark for better visibility */
        .modal {
            color: #333;
        }
        
        /* Animation classes */
        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" id="planModalLabel">Subscribe to Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @if(!Auth::check())
                <div class="modal-body d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white rounded">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        <h5 class="modal-title fw-semibold mb-0">Please log in first</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @else
                <div class="modal-body px-4 pt-2">
                    <form id="tenantForm" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control rounded-pill" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control rounded-pill" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <!-- Domain Name -->
                            <div class="col-md-12">
                                <x-input-label for="domain_name" :value="__('Domain Name')" />
                                <x-text-input id="domain_name" class="form-control rounded-pill" type="text" name="domain_name" :value="old('domain_name')" required />
                                <x-input-error :messages="$errors->get('domain_name')" class="mt-1" />
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control rounded-pill" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control rounded-pill" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>

                            <!-- Hidden fields for plan data -->
                            <input type="hidden" id="plan_id" name="plan_id">
                            <input type="hidden" id="plan_name" name="plan_name">
                            <input type="hidden" id="plan_price" name="plan_price">

                            <div class="col-12">
                                <p><strong>Plan Name:</strong> <span id="modalPlanName"></span></p>
                                <p><strong>Price:</strong> <span id="modalPlanPrice"></span></p>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="razorpayButton" class="btn btn-primary rounded-pill px-4">{{ __('Pay Now') }}</button>
                </div>
            @endif
        </div>
    </div>
</div>

@vite(['resources/js/app.js'])

<!-- Header Navigation -->
@if (Route::has('login'))
    <div class="position-absolute d-flex align-items-center top-0 end-0 p-3 text-end z-3">
        @auth
            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('Admin'))  
                <x-nav-link class="nav-link me-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            @endif
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none p-0"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="fw-semibold text-white text-decoration-none me-3">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="fw-semibold text-white text-decoration-none">Register</a>
            @endif
        @endauth
    </div>
@endif

<div class="container mx-auto p-8">
    <!-- Navigation -->
    <div class="flex justify-center gap-8 text-sm mb-10">
        <a href="#" class="opacity-70 hover:opacity-100 nav-link">Pricing</a>
        <a href="#" class="opacity-70 hover:opacity-100 nav-link">Changelog</a>
        <a href="#" class="opacity-70 hover:opacity-100 nav-link">Github</a>
        <a href="#" class="opacity-70 hover:opacity-100 nav-link">Go Pro</a>
    </div>
    
    <!-- Title Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-3 animate-fadeIn">Choose your plan</h1>
        <p class="text-gray-300 text-lg animate-fadeIn">Unlock endless possibilities</p>
    </div>
    
    <!-- Pricing Cards -->
    <div class="flex flex-col md:flex-row justify-center gap-8 pricing-container">
        @foreach($plan as $index => $item)
            <!-- Plan Card -->
            <div class="pricing-card flex flex-col md:w-1/3 w-full {{ $item->is_popular ? 'relative popular-plan' : '' }}">
                @if($item->is_popular)
                    <div class="popular-badge">Popular</div>
                @endif
                
                <h2 class="card-title font-bold {{ $item->name == 'Basic' ? 'text-teal-400' : ($item->name == 'Premium' ? 'text-pink-400' : 'text-blue-400') }}">{{ $item->name }}</h2>
                
                <p class="card-description text-gray-300">
                    {{ $item->description ?? ($item->name == 'Basic' ? 'Perfect for freelancers and small agencies starting with multitenancy' : 
                        ($item->name == 'Premium' ? 'Ideal for growing agencies and SaaS businesses' : 
                        'For institutions and organizations that require specialized support')) }}
                </p>
                
                <div class="flex items-baseline mt-4 mb-6">
                    <span class="price-currency">
                        @if($item->currency == 'INR')
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                        @elseif($item->currency == 'USD')
                            <i class="fa-solid fa-dollar-sign"></i>
                        @elseif($item->currency == 'EUR')
                            <i class="fa-solid fa-euro-sign"></i>
                        @else
                            {{ $item->currency }}
                        @endif
                    </span>
                    <span class="price font-bold">{{ $item->price }}</span>
                </div>
                
                @php
                    $buttonClass = $item->name == 'Premium' ? 'bg-pink-500 hover:bg-pink-600' : 'bg-gray-800 hover:bg-gray-700';
                    $checkClass = $item->name == 'Basic' ? 'basic-check' : ($item->name == 'Premium' ? 'premium-check' : 'enterprise-check');
                @endphp
                
                <button 
                    class="btn-get-started {{ $buttonClass }}"
                    data-bs-toggle="modal"
                    data-bs-target="#planModal"
                    data-name="{{ $item->name }}"
                    data-price="{{ $item->currency }} {{ number_format($item->price, 2) }}"
                    data-id="{{ $item->id }}"
                    onclick="updatePlanDetails('{{ $item->id }}', '{{ $item->name }}', '{{ $item->currency }} {{ number_format($item->price, 2) }}')"
                >
                    Get started
                </button>
                
                <div class="feature-list space-y-3 mt-auto">
                    @if($item->max_websites)
                        <div class="flex items-center feature-item">
                            <div class="check-circle {{ $checkClass }}">
                                <span class="text-xs">✓</span>
                            </div>
                            <span>{{ $item->max_websites }} tenant websites</span>
                        </div>
                    @endif
                    
                    @if(isset($item->features) && count($item->features) > 0)
                        @php
                            $featureText = $item->features[0]->description;
                            $featureLines = preg_split('/\r\n|\r|\n/', $featureText);
                        @endphp
                        
                        @foreach($featureLines as $line)
                            @if(trim($line) != '' && !in_array(trim($line), ['✓', '']))
                                <div class="flex items-center feature-item">
                                    <div class="check-circle {{ $checkClass }}">
                                        <span class="text-xs">✓</span>
                                    </div>
                                    <span>{{ trim(str_replace('✓', '', $line)) }}</span>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    
                    @if($item->storage_limit)
                        <div class="flex items-center feature-item">
                            <div class="check-circle {{ $checkClass }}">
                                <span class="text-xs">✓</span>
                            </div>
                            <span>{{ $item->storage_limit }}GB storage per tenant</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // When the Pay Now button is clicked
    const razorpayButton = document.getElementById('razorpayButton');
    if (razorpayButton) {
        razorpayButton.addEventListener('click', function() {
            // Validate the form
            const form = document.getElementById('tenantForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Collect form data
            const formData = new FormData(form);
            const name = formData.get('name');
            const email = formData.get('email');
            const planName = document.getElementById('modalPlanName').textContent;
            const planPrice = document.getElementById('modalPlanPrice').textContent.replace(/[^0-9.]/g, '');

            // Create Razorpay order
            fetch('{{ route("razorpay.create.order") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: parseFloat(planPrice) * 100, // Razorpay expects amount in paise
                    plan_id: formData.get('plan_id'),
                    plan_name: formData.get('plan_name')
                })
            })
            .then(response => response.json())
            .then(data => {
                // Initialize Razorpay
                const options = {
                    key: '{{ config("services.razorpay.key") }}',
                    amount: data.amount,
                    currency: 'INR',
                    name: 'Your Company Name',
                    description: planName + ' Subscription',
                    order_id: data.order_id,
                    prefill: {
                        name: name,
                        email: email
                    },
                    handler: function(response) {
                        // On successful payment, add payment details to form
                        const paymentField = document.createElement('input');
                        paymentField.type = 'hidden';
                        paymentField.name = 'razorpay_payment_id';
                        paymentField.value = response.razorpay_payment_id;
                        form.appendChild(paymentField);

                        const orderField = document.createElement('input');
                        orderField.type = 'hidden';
                        orderField.name = 'razorpay_order_id';
                        orderField.value = response.razorpay_order_id;
                        form.appendChild(orderField);

                        const signatureField = document.createElement('input');
                        signatureField.type = 'hidden';
                        signatureField.name = 'razorpay_signature';
                        signatureField.value = response.razorpay_signature;
                        form.appendChild(signatureField);

                        // Set form action and submit
                        form.action = '{{ route("tenant.store") }}';
                        form.submit();
                    },
                    modal: {
                        ondismiss: function() {
                            console.log('Payment cancelled');
                        }
                    }
                };

                const razorpay = new Razorpay(options);
                razorpay.open();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your payment. Please try again.');
            });
        });
    }

    // Function to update plan details in modal
    window.updatePlanDetails = function(planId, planName, planPrice) {
        document.getElementById('plan_id').value = planId;
        document.getElementById('plan_name').value = planName;
        document.getElementById('plan_price').value = planPrice;
        document.getElementById('modalPlanName').textContent = planName;
        document.getElementById('modalPlanPrice').textContent = planPrice;
    };
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add entrance animation for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.pricing-card');
        
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 300 + (index * 200));
        });
        
        // Modal functionality
        const planModal = document.getElementById('planModal');
        if (planModal) {
            planModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                if (button) {
                    // Get data from button
                    const name = button.getAttribute('data-name');
                    const price = button.getAttribute('data-price');
                    const id = button.getAttribute('data-id');
                    
                    // Update modal content
                    const modalPlanName = document.getElementById('modalPlanName');
                    const modalPlanPrice = document.getElementById('modalPlanPrice');
                    if (modalPlanName) modalPlanName.textContent = name;
                    if (modalPlanPrice) modalPlanPrice.textContent = price;
                    
                    // Update hidden form fields
                    const planIdField = document.getElementById('plan_id');
                    const planNameField = document.getElementById('plan_name');
                    const planPriceField = document.getElementById('plan_price');
                    
                    if (planIdField) planIdField.value = id;
                    if (planNameField) planNameField.value = name;
                    if (planPriceField) planPriceField.value = price;
                }
            });
        }
    });
</script>
</body>
</html>