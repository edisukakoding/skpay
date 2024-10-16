<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a href="{{ route('dashboard') }}">
            <b class="logo-abbr">
                {{-- <img src="{{ asset('library/theme/images/logo.png') }}" alt="">  --}}
                <i class="icon-energy icons text-white"></i>
            </b>
            <span class="logo-compact">
                {{-- <img src="{{ asset('library/theme/images/logo-compact.png') }}" alt=""> --}}
                <i class="icon-energy icons text-white"></i>
            </span>
            <span class="brand-title">
                {{-- <img src="{{ asset('library/theme/images/logo-text.png') }}" alt=""> --}}
                <h3 class="text-white"><i class="icon-energy icons"></i> SKPay</h3>
            </span>
        </a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        {{-- <div class="header-left">
            <div class="input-group icons">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
                            class="mdi mdi-magnify"></i></span>
                </div>
                <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                <div class="drop-down animated flipInX d-md-none">
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Search">
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="header-right">
            <ul class="clearfix">
                {{-- <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="badge badge-pill gradient-1">3</span>
                    </a>
                    <div class="drop-down animated fadeIn dropdown-menu">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                            <span class="">3 New Messages</span>
                            <a href="javascript:void()" class="d-inline-block">
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="javascript:void()">
                                        <img class="float-left mr-3 avatar-img"
                                            src="{{ asset('library/theme/images/avatar/1.jpg') }}" alt="">
                                        <div class="notification-content">
                                            <div class="notification-heading">Saiful Islam</div>
                                            <div class="notification-timestamp">08 Hours ago</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-unread">
                                    <a href="javascript:void()">
                                        <img class="float-left mr-3 avatar-img"
                                            src="{{ asset('library/theme/images/avatar/2.jpg') }}" alt="">
                                        <div class="notification-content">
                                            <div class="notification-heading">Adam Smith</div>
                                            <div class="notification-timestamp">08 Hours ago</div>
                                            <div class="notification-text">Can you do me a favour?</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void()">
                                        <img class="float-left mr-3 avatar-img"
                                            src="{{ asset('library/theme/images/avatar/3.jpg') }}" alt="">
                                        <div class="notification-content">
                                            <div class="notification-heading">Barak Obama</div>
                                            <div class="notification-timestamp">08 Hours ago</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void()">
                                        <img class="float-left mr-3 avatar-img"
                                            src="{{ asset('library/theme/images/avatar/4.jpg') }}" alt="">
                                        <div class="notification-content">
                                            <div class="notification-heading">Hilari Clinton</div>
                                            <div class="notification-timestamp">08 Hours ago</div>
                                            <div class="notification-text">Hello</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </li> --}}
                <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        @php
                            $total_notification = App\Models\Notification::whereIsread(false)->count();
                        @endphp
                        @if ($total_notification !== 0)
                            <span class="badge badge-pill gradient-2">{{ $total_notification }}</span>
                        @endif
                    </a>
                    <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                            <span
                                class="">{{ $total_notification !== 0 ? 'Pemberitahuan' : 'Tidak ada pemberitahuan' }}</span>
                            @if ($total_notification !== 0)
                                <a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-2">{{ $total_notification }}</span>
                                </a>
                            @endif
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                @foreach (App\Models\Notification::whereIsread(false)->limit(5)->get() as $item)
                                    <li>
                                        <a href="{{ $item->redirect }}?isread=true&id={{ $item->id }}">
                                            <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                    class="icon-check"></i></span>
                                            <div class="notification-content">
                                                <h6 class="notification-heading">{{ $item->title }}</h6>
                                                <span
                                                    class="notification-text">{{ Carbon\Carbon::parse($item->notification_time)->locale('id')->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </li>
                {{-- <li class="icons dropdown d-none d-md-flex">
                    <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                        <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                    </a>
                    <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="javascript:void()">English</a></li>
                                <li><a href="javascript:void()">Dutch</a></li>
                            </ul>
                        </div>
                    </div>
                </li> --}}
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ asset('library/theme/images/user/1.png') }}" height="40" width="40"
                            alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                {{-- <li>
                                    <a href="app-profile.html"><i class="icon-user"></i>
                                        <span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void()">
                                        <i class="icon-envelope-open"></i> <span>Inbox</span>
                                        <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                    </a>
                                </li>

                                <hr class="my-2">
                                <li>
                                    <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                            Screen</span></a>
                                </li> --}}
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="$(this).parent('form').submit()"><i
                                                class="icon-key"></i> <span>Logout</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
