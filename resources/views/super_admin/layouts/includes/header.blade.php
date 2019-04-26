<nav class="navbar header-navbar pcoded-header" style="min-height: 90px;">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                <i class="feather icon-toggle-right"></i>
            </a>

            <a href="{{ route('super_admin.dashboard') }}">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Theme-Logo" style="padding-top: 45px;">
            </a>

            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                                
                                <img src="{{ asset('images/avatar-4.jpg') }}" class="img-radius" alt="User-Profile-Image">

                            <span>{{ Auth::guard('admin')->user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>

                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                             {{-- <li>
                               <a href="{{ route('profile') }}">
                                    <i class="feather icon-user"></i> Profile
                                </a> 
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#changePassword">
                                    <i class="icofont icofont-key"></i> Change Password
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('super_admin.logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>