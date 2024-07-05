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
                        if (in_array(session('view_name'), ['admin.member.members.index', 'admin.users.role.index'])) {
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
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.users.role.index' ? 'active' : '' }}"
                                    data-key="t-user">Roles</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    @php
                        $active = $show = '';
                        if (in_array(session('view_name'), ['admin.disclosures.disclosure.index'])) {
                            $active = 'active';
                            $show = 'show';
                        }
                    @endphp
                    <a class="nav-link menu-link {{ $active }}" href="#sidebarDisclosures"
                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarDisclosures">
                        <i class="bx bx-list-ul"></i> <span data-key="t-users">Disclosures</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $show }}" id="sidebarDisclosures">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.disclosures') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.disclosures.disclosure.index' ? 'active' : '' }}"
                                    data-key="t-user">Disclosures</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    @php
                        $active = $show = '';
                        if (in_array(session('view_name'), ['admin.contacts.contact.index'])) {
                            $active = 'active';
                            $show = 'show';
                        }
                    @endphp
                    <a class="nav-link menu-link {{ $active }}" href="#sidebarContacts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarContacts">
                        <i class="ri-contacts-line"></i> <span data-key="t-users">Messages</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $show }}" id="sidebarContacts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.contacts') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.contacts.contact.index' ? 'active' : '' }}"
                                    data-key="t-user">Message</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    @php
                        $active = $show = '';
                        if (in_array(session('view_name'), ['admin.news.news.index', 'admin.news.archive.index'])) {
                            $active = 'active';
                            $show = 'show';
                        }
                    @endphp
                    <a class="nav-link menu-link {{ $active }}" href="#sidebarNews" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarNews">
                        <i class="ri-newspaper-line"></i> <span data-key="t-users">News</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $show }}" id="sidebarNews">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.news') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.news.news.index' ? 'active' : '' }}"
                                    data-key="t-user">News</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.news.archive.index') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.news.archive.index' ? 'active' : '' }}"
                                    data-key="t-user">Archived</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    @php
                        $active = $show = '';
                        if (in_array(session('view_name'), ['admin.medias.index'])) {
                            $active = 'active';
                            $show = 'show';
                        }
                    @endphp
                    <a class="nav-link menu-link {{ $active }}" href="#sidebarMedia" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarMedia">
                        <i class="ri-newspaper-line"></i> <span data-key="t-users">Media</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $show }}" id="sidebarMedia">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.medias') }}" target="_self"
                                    class="nav-link {{ session('view_name') == 'admin.medias.index' ? 'active' : '' }}"
                                    data-key="t-user">Media</a>
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
