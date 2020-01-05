<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('profile.update')}}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link @if($activePage == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @canany(['can_manage_uptime'])
                    <li class="nav-item has-treeview
                    @if(in_array($activePage, ['uptime'])) menu-open @endif">
                        <a href="#" class="nav-link
                        @if(in_array($activePage, ['uptime'])) active @endif">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Administrator Tools
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('can_manage_uptime')
                                <li class="nav-item">
                                    <a href="{{route('uptime.index')}}"
                                       class="nav-link @if($activePage == 'uptime') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Uptime Monitor
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['can_view_users','can_view_roles','can_view_permissions'])
                    <li class="nav-item has-treeview
                    @if(in_array($activePage, ['users','roles','permissions'])) menu-open @endif">
                        <a href="#" class="nav-link
                        @if(in_array($activePage, ['users','roles','permissions'])) active @endif">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('can_view_users')
                                <li class="nav-item">
                                    <a class="nav-link @if($activePage == 'users') active @endif"
                                       href="{{route('users.index')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                            @endcan
                            @can('can_view_roles')
                                <li class="nav-item">
                                    <a class="nav-link @if($activePage == 'roles') active @endif"
                                       href="{{route('roles.index')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <span>Roles</span>
                                    </a>
                                </li>
                            @endcan
                            @can('can_view_permissions')
                                <li class="nav-item">
                                    <a class="nav-link @if($activePage == 'permissions') active @endif"
                                       href="{{route('permissions.index')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <span>Permissions</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
