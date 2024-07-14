<!-- ========== TOP HEADER MODULE ========== -->
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">

            <div class="d-flex">

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <a href="{{ route('home') }}" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle">
                        <i class='bx bx-home fs-22'></i>
                    </a>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">

                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('admin-assets/images/users/avatar-demo.png') }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->first_name }}
                                    {{ auth()->user()->full_name }}</span>
                            </span>
                        </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome {{ auth()->user()->full_name }} !</h6>
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                            <i class='bx bx-log-out-circle'></i>
                            <span>Logout</span>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</header>
<!-- ========== --end-- TOP HEADER MODULE ========== -->
