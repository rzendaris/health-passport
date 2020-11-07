<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="heading">
            <h3 class="uppercase">Menu</h3>
        </li>
        @if(env('ENV') == 'ADMIN')

        <li class="nav-item {{ Request::is('user-management') || Request::is('user-management/*') ? 'active' : '' }}">
            <a href="{{ url('user-management') }}" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">User Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('developer-management') || Request::is('developer-management/*') ? 'active' : '' }}">
            <a href="{{ url('developer-management') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Developer Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('apps-management') || Request::is('apps-management/*') ? 'active' : '' }}">
            <a href="{{ url('apps-management') }}" class="nav-link nav-toggle">
                <i class="fa fa-android"></i>
                <span class="title">Apps Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('a') || Request::is('a/*') ? 'active' : '' }}">
            <a href="{{ url('end-user-management') }}" class="nav-link nav-toggle">
                <i class="fa fa-user-secret"></i>
                <span class="title">End User Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('ads-management') || Request::is('ads-management/*') ? 'active' : '' }}">
            <a href="{{ url('ads-management') }}" class="nav-link nav-toggle">
                <i class="fa fa-pie-chart"></i>
                <span class="title">Ads Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('report') || Request::is('report/*') ? 'active' : '' }}">
            <a href="{{ url('report') }}" class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Report </span>
            </a>
        </li>
        @elseif(env('ENV') == 'DEVELOPER')
        <li class="nav-item {{ Request::is('apps-developer') || Request::is('apps-developer/*') ? 'active' : '' }}">
            <a href="{{ url('apps-developer') }}" class="nav-link nav-toggle">
                <i class="fa fa-android"></i>
                <span class="title">Apps Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('feedbacks-and-reply') || Request::is('feedbacks-and-reply/*') ? 'active' : '' }}">
            <a href="{{ url('feedbacks-and-reply') }}" class="nav-link nav-toggle">
                <i class="fa fa-user-secret"></i>
                <span class="title">Feedback And Reply </span>
            </a>
        </li>
        @else
        @endif
    </ul>
</div>
<!-- <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="heading">
            <h3 class="uppercase">Menu</h3>
        </li>
        <li class="nav-item {{ Request::is('dashboard')? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('family-management') || Request::is('family-management/*') ? 'active' : '' }}">
            <a href="{{ url('family-management') }}" class="nav-link nav-toggle">
                <i class="icon-user-follow"></i>
                <span class="title">Family Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('family-tree') || Request::is('family-tree-detail/*') ? 'active' : '' }}">
            <a href="{{ url('family-tree') }}" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">Family Tree </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('master/*')? 'open active' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">Master Data</span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  {{ Request::is('master/ethnic')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/ethnic') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Etnis</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/degree')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/degree') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Gelar</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/job')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/job') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Pekerjaan</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/province')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/province') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Provinsi</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/city')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/city') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Kota / Kabupaten</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/district')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/district') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Kecamatan</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('master/village')? 'border-r-active' : '' }}">
                    <a href="{{ url('master/village') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Kelurahan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ Request::is('user-management-fe')? 'active' : '' }}">
            <a href="{{ url('user-management-fe') }}" class="nav-link nav-toggle">
                <i class="icon-user-follow"></i>
                <span class="title">User Management </span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('report')? 'active' : '' }}">
            <a href="{{ url('report') }}" class="nav-link nav-toggle">
                <i class="icon-book-open"></i>
                <span class="title">Report </span>
            </a>
        </li>
    </ul>
</div> -->
