<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Management Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #10B981;
            --dark-color: #1F2937;
            --light-color: #F9FAFB;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F3F4F6;
        }
        
        .sidebar {
            background-color: var(--dark-color);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 250px;
        }
        
        .sidebar .logo {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar ul {
            padding: 0;
            list-style: none;
        }
        
        .sidebar ul li {
            padding: 0;
        }
        
        .sidebar ul li a {
            color: #D1D5DB;
            text-decoration: none;
            display: block;
            padding: 15px 20px;
            transition: all 0.3s;
        }
        
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #E5E7EB;
            font-weight: bold;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #6B7280;
        }
        
        .form-check-input {
            width: 2.5em;
            height: 1.2em;
        }
        
        [type=checkbox]:checked {
            background-color: #10B981;
            border-color: #10B981;
        }
        
        [type=checkbox]:checked:hover, [type=checkbox]:checked:focus {
            background-color: #10B981;
            border-color: #10B981;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        
        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card .label {
            color: #6B7280;
            font-size: 14px;
        }
        
        .bg-primary-light {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }
        
        .bg-success-light {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--secondary-color);
        }
        
        .bg-warning-light {
            background-color: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
        }
        
        .bg-danger-light {
            background-color: rgba(239, 68, 68, 0.1);
            color: #EF4444;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info .name {
            margin-left: 10px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
    <div class="logo">
        <i class="fas fa-cloud"></i> TenantPanel
    </div>
    <ul>
        <li>
            <a href="#" class="active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{url('subscriptiondashboardplan')}}" class="active">
                <i class="fas fa-tachometer-alt"></i> Plans
            </a>
        </li>

        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h2 class="m-0">Tenant Management</h2>
            <div class="user-info">
                <div class="avatar">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=4F46E5&color=fff" alt="Admin" width="100%">
                </div>
                <div class="name">Admin</div>
            </div>
        </div>

        <!-- Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="icon bg-primary-light">
                    <i class="fas fa-building"></i>
                </div>
                <div class="number">{{ count($tenants) }}</div>
                <div class="label">Total Tenants</div>
            </div>
            <div class="stat-card">
                <div class="icon bg-success-light">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="number">{{ count($tenants) }}</div>
                <div class="label">Active Domains</div>
            </div>
            <div class="stat-card">
                <div class="icon bg-warning-light">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="number">₹{{ number_format($tenants->count() * 1000) }}</div>
                <div class="label">Revenue</div>
            </div>
            <div class="stat-card">
                <div class="icon bg-danger-light">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="number">100%</div>
                <div class="label">Growth</div>
            </div>
        </div>

        <!-- Tenants Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>All Tenants</div>
                <a href="{{ url('tanent/create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Tenant
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Domain Name</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $index => $tenant)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tenant->name }}</td>
                                <td>{{ $tenant->email }}</td>
                                <td>
                                    @if($tenant->domains->count() > 0)
                                        <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank">
                                            {{ $tenant->domains->first()->domain }}
                                        </a>
                                    @else
                                        <span class="text-muted">No domain</span>
                                    @endif
                                </td>
                                <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggleStatus"
                                            type="checkbox"
                                            role="switch"
                                            data-id="{{ $tenant->id }}"
                                            {{ $tenant->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle tenant status
            $('.toggleStatus').change(function() {
                const tenantId = $(this).data('id');
                const status = $(this).prop('checked') ? 1 : 0;
                
                $.ajax({
                    url: '/tenant/toggle-status/' + tenantId,
                    type: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Failed to update status');
                    }
                });
            });
        });
    </script>
</body>
</html>