<div class="page-header-inner ">
    <div class="page-logo">
        <a href="/">
            <!-- <h4 class="logo-default">IWS</h4> -->
            <img src="{{ asset('assets/global/img/logo.png') }}" alt="" width="100" class="logo-default" />
        </a>
        <div class="menu-toggler sidebar-toggler">

        </div>
    </div>

    <a class="logout-on-mobile hidden-md hidden-lg" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-key"></i> Logout</a>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

    <div class="page-top hidden-xs hidden-sm">
        <!-- <form class="search-form" action="page_general_search_2.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i>
                    </a>
                </span>
            </div>
        </form> -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="separator hide"></li>
                <li class="separator hide"></li>
                <li class="separator hide"></li>
                <li>
                  <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" ></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                    <div class="dropdown-menu notif-data" aria-labelledby="notification-menu-navbar" style="min-width: 250px;max-height: 340px;overflow: scroll;box-shadow: 0 0 10px 2px #efefef;">
                        <div class="card">
                            <div class="card-body">
                                <div class="list-group">
                                <ul class="dropdown-menu notif-data"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   </li>
                  </ul>
                </li>
                <li>
                    <a class="nav-link dropdown-toggle" href="#" id="user-menu-navbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user fa-lg"></i> <i class="fa fa-sort-desc"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="user-menu-navbar">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group text-center" style=" margin-bottom: 0; ">
                                    @if(env('ENV') == 'ADMIN')
                                    <li class="list-group-item">
                                      <a href="{{ url('profile-admin') }}">Profile</a>
                                    </li>
                                    @elseif(env('ENV') == 'DEVELOPER')
                                    <li class="list-group-item">
                                        <a href="{{ url('profile') }}">Profile</a>
                                    </li>
                                    @endif

                                    <li class="list-group-item">
                                        <a href="{{ url('profile-password') }}">Change Passowrd</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item" href="#">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
        </div>

    </div>

</div>
