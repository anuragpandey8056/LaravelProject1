<!-- Font Awesome CDN for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
    .sidebar-link {
    padding: 10px 10px;
    border-radius: 8px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.sidebar-link:hover {
    background-color: #343a40;
    transform: translateX(0.5px);
    color:rgb(241, 162, 50) !important;
}
</style>
           

  





<!-- Sidebar for large screens -->
<aside id="sidebar" class="bg-dark text-white d-none d-lg-block sidebar">
    <nav class="nav flex-column gap-4">
       

   
        <a class="nav-link text-white sidebar-link" href="{{url('/dashboard')}}">
            <i class="fas fa-house me-2"></i> Dashboard
        </a>
        <a class="nav-link text-white sidebar-link" href="{{ url('/viewproduct') }}">
            <i class="fas fa-book-open me-2"></i> View Products
        </a>
        <a class="nav-link text-white sidebar-link" href="{{ url('/addhero') }}">
            <i class="fas fa-briefcase me-2"></i>Hero
        </a>
        <a class="nav-link text-white sidebar-link" href="{{ url('/addblog') }}">
            <i class="fas fa-magnifying-glass me-2"></i> Admin Blog
        </a>
        
        <a class="nav-link text-white sidebar-link" href="{{ url('/updateproducts') }}">
            <i class="fas fa-file-pen me-2"></i> Update Products
        </a>
        
    
        <a class="nav-link text-white sidebar-link" href="{{ url('/roles') }}">
            <i class="fas fa-briefcase me-2"></i> Roles
        </a>
        <a class="nav-link text-white sidebar-link" href="{{ url('/permission') }}">
            <i class="fas fa-magnifying-glass me-2"></i> Permission
        </a>
        <a class="nav-link text-white sidebar-link" href="{{ url('/users') }}">
            <i class="fas fa-file-pen me-2"></i> User
        </a>
        <a class="nav-link text-white sidebar-link" href="{{url('tanent/create')}}">
            <i class="fas fa-file-pen me-2"></i> Tanent
        </a>
  

        <!-- Log Out as full clickable nav-link -->
        <form method="POST" action="{{ url('tenantlogout') }}">
            @csrf
            <button type="submit" class="nav-link text-white sidebar-link w-100 text-start btn-logout">
                <i class="fas fa-right-from-bracket me-2"></i> Log Out
            </button>
        </form>

    </nav>
</aside>




<!-- Offcanvas Sidebar (mobile only) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel" style="width: 260px;">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-dark text-white">
        <nav class="nav flex-column gap-3">
            <a class="nav-link text-white sidebar-link" href="{{ url('/home') }}"><i class="fas fa-house me-2"></i> Dashboard</a>
            <a class="nav-link text-white sidebar-link" href="{{ url('/viewproducts') }}"><i class="fas fa-book-open me-2"></i> View Products</a>
            <a class="nav-link text-white sidebar-link" href="{{ url('/addproducts') }}"><i class="fas fa-briefcase me-2"></i> Upload Products</a>
            <a class="nav-link text-white sidebar-link" href="{{ url('/searchproducts') }}"><i class="fas fa-magnifying-glass me-2"></i> Search Products</a>
            <a class="nav-link text-white sidebar-link" href="{{ url('/updateproducts') }}"><i class="fas fa-file-pen me-2"></i> Update Products</a>
            <a class="nav-link text-white sidebar-link" href="{{ url('/tenantlogout') }}"><i class="fas fa-right-from-bracket me-2"></i> Logout</a>
        </nav>
    </div>
</div>


<script>
document.getElementById('sidebarToggle').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('d-none');
});
</script>




