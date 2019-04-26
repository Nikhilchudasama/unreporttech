<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li {{ $page == 'Dashboard' ? ' class=active' : '' }}>
                <a href="{{ route('super_admin.dashboard') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard </span>
                </a>
            </li>
            <li {{ $page == 'User' ? ' class=active' : '' }}>
                <a href="{{ route('super_admin.user.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                    </span>
                    <span class="pcoded-mtext">User </span>
                </a>
            </li>
        </ul>
    </div>
</nav>