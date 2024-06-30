<!-- ========== SIDEBAR MODULE ========== -->
<div class="app-menu navbar-menu">


    <div class="navbar-brand-box mt-3">
        @php
            $segment1 = request()->segment(1);
            $segment2 = request()->segment(2);

        @endphp
        <a href="{{ route('admin.home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <h2 style="color: #fff; padding-top: 20px; margin-bottom: 0"></h2>
            </span>
        </a>

        <a href="{{ route('admin.home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- <h2 style="color: #fff; padding-top: 20px; margin-bottom: 0">
                    {{ $settings->short_name ?? 'Company Name' }}</h2> --}}
                <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="" height="40">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.home') }}" role="button" aria-expanded="false">
                        <i class="bx bx-home-alt"></i> <span data-key="t-dashboards">Home</span>
                    </a>
                </li>


                <li class="nav-item">
                    @php
                        $active = $show = '';
                        if (in_array(session('view_name'), ['admin.member.members.index'])) {
                            $active = 'active';
                            $show = 'show';
                        }
                    @endphp
                    <a class="nav-link menu-link {{ $active }}" href="#sidebarUsers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-user-line"></i> <span data-key="t-users">Member</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $show }}" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.members') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.member.members.index' ? 'active' : '' }}"
                                    data-key="t-user">Members</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- ========== --end-- SIDEBAR MODULE ========== -->
