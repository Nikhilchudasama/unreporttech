<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li {{ $page == 'Dashboard' ? ' class=active' : '' }}>
                <a href="{{ route('admin.dashboard') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard </span>
                </a>
            </li>
            <li {{ $page == 'Branch' ? ' class=active' : '' }}>
                <a href="{{ route('admin.branch.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="icofont icofont-company"></i>
                    </span>
                    <span class="pcoded-mtext">Branch </span>
                </a>
            </li>
            <li {{ $page == 'Fee Offer' ? ' class=active' : '' }}>
                <a href="{{ route('admin.feeOffer.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-briefcase"></i>
                    </span>
                    <span class="pcoded-mtext">Fee Offer</span>
                </a>
            </li>
            <li {{ $page == 'User' ? ' class=active' : '' }}>
                <a href="{{ route('admin.user.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                    </span>
                    <span class="pcoded-mtext">User </span>
                </a>
            </li>
            <li {{ $page == 'Student' ? ' class=active' : '' }}>
                <a href="{{ route('admin.student.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="icofont icofont-group-students"></i>
                    </span>
                    <span class="pcoded-mtext">Student </span>
                </a>
            </li>
            <li {{ $page == 'Academic Year' ? ' class=active' : '' }}>
                <a href="{{ route('admin.academicYear.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="icofont icofont-exchange"></i>
                    </span>
                    <span class="pcoded-mtext">Academic Year </span>
                </a>
            </li>
            <li {{ $page == 'Setting' ? ' class=active' : '' }}>
                <a href="{{ route('admin.setting.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="icofont icofont-settings"></i>
                    </span>
                    <span class="pcoded-mtext">Setting </span>
                </a>
            </li>
        </ul>
    </div>
</nav>
