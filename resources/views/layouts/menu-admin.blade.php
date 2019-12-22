<div class="card">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
        @can('can_view_users')
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">Users</a>
            </li>
        @endcan
        @can('can_view_roles')
            <li class="nav-item">
                <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
            </li>
        @endcan
        @can('can_view_permissions')
            <li class="nav-item">
                <a class="nav-link" href="{{route('permissions.index')}}">Permissions</a>
            </li>
        @endcan
    </ul>
</div>
