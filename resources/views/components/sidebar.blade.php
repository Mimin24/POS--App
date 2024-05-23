<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">HYDROBAKO</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">HB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Admin</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('users.index') }}">User</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('products.index') }}">Product</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('categories.index') }}">Category</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
