<!-- resources/views/pricing.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
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
        
        .pricing-card:hover .check-circle {
            transform: scale(1.2);
        }
        
        .basic-check {
            background-color: rgb(59, 130, 246);
        }
        .premium-check {
            background-color: rgb(236, 72, 153);
        }
        .enterprise-check {
            background-color: rgb(59, 130, 246);
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
    </style>
</head>
<body>
    <div class="container mx-auto p-8">
        <!-- Navigation -->
        <div class="flex justify-center gap-8 text-sm mb-10">
            <a href="#" class="opacity-70 hover:opacity-100 nav-link">Pricing</a>
            <a href="#" class="opacity-70 hover:opacity-100 nav-link">changelog</a>
            <a href="#" class="opacity-70 hover:opacity-100 nav-link">Github</a>
            <a href="#" class="opacity-70 hover:opacity-100 nav-link">GO Pro</a>
        </div>
        
        <!-- Title Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-3 animate-fadeIn">Choose your plan</h1>
            <p class="text-gray-300 text-lg animate-fadeIn">unlock endless possibilities</p>
        </div>
        
        <!-- Pricing Cards -->
        <div class="flex flex-col md:flex-row justify-center gap-8 pricing-container">
            <!-- Basic Plan -->
            <div class="pricing-card flex flex-col md:w-1/3 w-full" style="animation-delay: 0.1s">
                <h2 class="card-title font-bold text-teal-400">Basic</h2>
                <p class="card-description text-gray-300">Perfect for freelancers and small agencies starting with multitenancy</p>
                
                <div class="flex items-baseline mt-4 mb-6">
                    <span class="price-currency"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <span class="price font-bold">5</span>
                </div>
                
                <a href="{{ route('register') }}" class="action-button bg-gray-800 text-white rounded-lg text-center hover:bg-gray-700 mt-auto">Get Start</a>
                
                <div class="feature-list space-y-3 mt-auto">
                    <div class="flex items-center feature-item">
                        <div class="check-circle basic-check">
                            <span class="text-xs">✓</span>
                        </div>
                        ✓
                        <span>5 tenant websites</span>


                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle basic-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Basic tenant dashboard</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle basic-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>2GB storage per tenant</span>
                    </div>
                </div>
            </div>
            
            <!-- Premium Plan -->
            <div class="pricing-card flex flex-col md:w-1/3 w-full relative popular-plan" style="animation-delay: 0.2s">
                <div class="popular-badge">Popular</div>
                
                <h2 class="card-title font-bold text-pink-400">Premium</h2>
                <p class="card-description text-gray-300">Ideal for growing agencies and SaaS businesses</p>
                
                <div class="flex items-baseline mt-4 mb-6">
                    <span class="price-currency"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <span class="price font-bold">15.99</span>
                </div>
                
                <a href="" class="action-button bg-pink-500 text-white rounded-lg text-center hover:bg-pink-600 mt-auto">Get Start</a>
                
                <div class="feature-list space-y-3 mt-auto">

                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Unlimited tenant websites</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Custom tenant templates</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Advanced user permissions</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>30GB storage per tenant</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Dedicated account manager</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle enterprise-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Custom API integration</span>
                    </div>
                </div>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="pricing-card flex flex-col md:w-1/3 w-full" style="animation-delay: 0.3s">
                <h2 class="card-title font-bold text-blue-400">Enterprise</h2>
                <p class="card-description text-gray-300">For institutions and organizations that require specialized support</p>
                
                <div class="flex items-baseline mt-4 mb-6">
                    <span class="price-currency"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <span class="price font-bold">9</span>
                </div>
                
                <a href="" class="action-button bg-gray-800 text-white rounded-lg text-center hover:bg-gray-700 mt-auto">Get Start</a>
                
                <div class="feature-list space-y-3 mt-auto">
                <div class="flex items-center feature-item">
                        <div class="check-circle premium-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>25 tenant websites</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle premium-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>White label administration</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle premium-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>Advanced tenant dashboard</span>
                    </div>

                    <div class="flex items-center feature-item">
                        <div class="check-circle premium-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>
                        10GB storage per tenant</span>
                    </div>
                    <div class="flex items-center feature-item">
                        <div class="check-circle premium-check">
                            <span class="text-xs">✓</span>
                        </div>
                        <span>
                        Priority support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        });
    </script>
</body>
</html>