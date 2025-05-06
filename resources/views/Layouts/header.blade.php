
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhanced Dark Minimal Navbar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Helvetica Neue', Arial, sans-serif;
    }
    
    body {
      background-color: #f5f5f5;
    }
    
    .navbar {
      background-color: #000;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 5%;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    
    .logo {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 1.2rem;
      letter-spacing: 1px;
    }
    
    .logo img {
      height: 32px;
      margin-right: 10px;
    }
    
    .nav-links {
      display: flex;
      list-style: none;
    }
    
    .nav-links li {
      margin: 0 15px;
    }
    
    .nav-links a {
      color: #fff;
      text-decoration: none;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
      transition: opacity 0.3s;
    }
    
    .nav-links a:hover {
      opacity: 0.7;
    }
    
    .search-box {
      position: relative;
      margin-left: auto;
      margin-right: 20px;
    }
    
    .search-box input {
      padding: 8px 35px 8px 12px;
      border-radius: 20px;
      border: none;
      background-color: #333;
      color: #fff;
      font-size: 0.85rem;
      width: 180px;
      transition: all 0.3s;
    }
    
    .search-box input:focus {
      outline: none;
      background-color: #444;
      width: 220px;
    }
    
    .search-box button {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #aaa;
      cursor: pointer;
    }
    
    .search-box button:hover {
      color: #fff;
    }
    
    .right-section {
      display: flex;
      align-items: center;
    }
    
    .auth-buttons {
      display: flex;
      margin-right: 15px;
    }
    
    .auth-buttons a {
      color: #fff;
      text-decoration: none;
      font-size: 0.85rem;
      padding: 6px 12px;
      border-radius: 4px;
      transition: background-color 0.3s, opacity 0.3s;
    }
    
    .login-btn {
      background-color: transparent;
      border: 1px solid rgba(255, 255, 255, 0.3);
      margin-right: 8px;
    }
    
    .login-btn:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    
    .register-btn {
      background-color: #0066cc;
    }
    
    .register-btn:hover {
      opacity: 0.85;
    }
    
    .logout-btn {
      background-color: #333;
      display: none; /* Toggle with login/register buttons via JS */
    }
    
    .logout-btn:hover {
      background-color: #444;
    }
    
    .social-icons {
      display: flex;
      align-items: center;
    }
    
    .social-icons a {
      color: #fff;
      margin-left: 15px;
      font-size: 0.9rem;
      transition: opacity 0.3s;
    }
    
    .social-icons a:hover {
      opacity: 0.7;
    }
    
    .hamburger {
      display: none;
      cursor: pointer;
      background: none;
      border: none;
      color: white;
      font-size: 1.2rem;
    }
    
    @media (max-width: 1024px) {
      .search-box {
        width: 150px;
      }
      
      .search-box input {
        width: 150px;
      }
      
      .search-box input:focus {
        width: 180px;
      }
    }
    
    @media (max-width: 768px) {
      .nav-links {
        display: none;
        position: absolute;
        flex-direction: column;
        background-color: #000;
        width: 100%;
        top: 60px;
        left: 0;
        padding: 20px 0;
        text-align: center;
        z-index: 2;
      }
      
      .nav-links.active {
        display: flex;
      }
      
      .nav-links li {
        margin: 15px 0;
      }
      
      .hamburger {
        display: block;
        order: 1;
      }
      
      .logo {
        order: 2;
      }
      
      .right-section {
        order: 3;
      }


      .logout-btn {
    display: inline-block !important;
}
      
      .search-box {
        display: none;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        padding: 10px 20px;
        background-color: #000;
        z-index: 1;
      }
      
      .search-box.active {
        display: block;
      }
      
      .search-box input {
        width: 100%;
      }
      
      .search-toggle {
        display: block;
        background: none;
        border: none;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        margin-right: 10px;
      }
      
      .auth-buttons {
        margin-right: 5px;
      }
      
      .auth-buttons a {
        padding: 5px 8px;
        font-size: 0.8rem;
      }
      
      .navbar {
        padding: 12px 4%;
      }
      
      .social-icons {
        display: none;
      }
      
      .social-icons.active {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 15px 0;
        background-color: #000;
        position: absolute;
        left: 0;
        top: 156px;
      }
      
      .social-icons.active a {
        margin: 0 15px;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="https://marketplace.canva.com/EAGQ1aYlOWs/1/0/1600w/canva-blue-colorful-illustrative-e-commerce-online-shop-logo-bHiX_0QpJxE.jpg" alt="Logo">
     
    </div>
    
    <button class="hamburger" id="hamburger">
      <i class="fas fa-bars"></i>
    </button>
    
    <ul class="nav-links" id="navLinks">
  
      <li><a href="{{route('/index')}}">Home</a></li>
      <li><a href="{{ url('contact')  }}">Contact</a></li>
      <li><a href="{{ url('shop')  }}">Shop</a></li>
      <li><a href="{{ url('contact2')}} ">contact</a></li>
      <li><a href="{{ url('/about')  }}">About Us</a></li>
      
  
      @auth
                @if(Auth::user()->type!='user')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('dashboard')" :active="request()->is('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @endif
      @endauth

    </ul>
    
    <div class="right-section">
      <div class="search-box" id="searchBox">
        <input type="text" placeholder="Search...">
        <button type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
      
      <button class="search-toggle" id="searchToggle" style="display: none;">
        <i class="fas fa-search"></i>
      </button>
    
      <div class="auth-buttons">
    @auth
        <span class="user-name">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ url('tenantlogout') }}" style="display: inline;" id="logout-form">
            @csrf
            <button type="submit"
                class="text-sm text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg px-5 py-2.5"
                onclick="setTimeout(() => window.location.reload(), 100);"
            >
                {{ __('Log Out') }}
            </button>
        </form>
    @else
        <a href="{{ url('tenantlogin') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
            Log in
        </a>
        <a href="{{ url('tenantregister') }}" class="text-gray-900 bg-white border border-gray-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Register
        </a>
    @endauth
</div>


</div>

      
      <div class="social-icons" id="socialIcons">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        @php
    $cart = session('cart', []); // Get cart from session or use an empty array
    $cartCount = count($cart);
@endphp

@if($cartCount > 0)
    <div style="
        background-color: red;
        color: white;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        position: absolute;
        top: 12px;
        right: 22px;">
        {{ $cartCount }}
    </div>
@endif




       
        <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a>


        <a href="#"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
  </nav>

  <script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const searchToggle = document.getElementById('searchToggle');
    const searchBox = document.getElementById('searchBox');
    const socialIcons = document.getElementById('socialIcons');
    
    // Toggle mobile navigation
    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      
      // Hide search box and social icons if showing
      if (searchBox.classList.contains('active')) {
        searchBox.classList.remove('active');
      }
      
      if (socialIcons.classList.contains('active')) {
        socialIcons.classList.remove('active');
      } else if (navLinks.classList.contains('active')) {
        socialIcons.classList.add('active');
      }
    });
    
    // Toggle search box on mobile
    if (searchToggle) {
      searchToggle.addEventListener('click', () => {
        searchBox.classList.toggle('active');
        
        // Hide nav links if showing
        if (navLinks.classList.contains('active')) {
          navLinks.classList.remove('active');
          socialIcons.classList.remove('active');
        }
      });
    }
    
    // Media query listener for responsive adjustments
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    
    function handleScreenChange(e) {
      if (e.matches) {
        // Switch to mobile layout
        if (!searchToggle) return;
        searchToggle.style.display = 'block';
      } else {
        // Switch to desktop layout
        if (!searchToggle) return;
        searchToggle.style.display = 'none';
        searchBox.classList.remove('active');
        navLinks.classList.remove('active');
        socialIcons.classList.remove('active');
      }
    }
    
    // Initial check
    handleScreenChange(mediaQuery);
    
    // Add listener for changes
    mediaQuery.addEventListener('change', handleScreenChange);
    
    // Auth state change simulation (for demo purposes)
    // In a real app, you would check if user is logged in here
    // const loginBtn = document.querySelector('.login-btn');
    // const registerBtn = document.querySelector('.register-btn');
    // const logoutBtn = document.querySelector('.logout-btn');
    
    // function showLoggedInState() {
    //   loginBtn.style.display = 'none';
    //   registerBtn.style.display = 'none';
    //   logoutBtn.style.display = 'block';
    // }
    
    // function showLoggedOutState() {
    //   loginBtn.style.display = 'block';
    //   registerBtn.style.display = 'block';
    //   logoutBtn.style.display = 'none';
    // }
    
    // Default state: logged out
    showLoggedOutState();
    
    // Example toggle for demo
    loginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showLoggedInState();
    });
    
    logoutBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showLoggedOutState();
    });
  </script>
</body>
</html>


























