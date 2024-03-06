<div class="menu-wrap">
    <div class="d-flex flex-row justify-content-between align-items-center menu-button-container">
        <button class="close-button" id="close-button"></button>

        <a class="loginBtn sideBar-loginBtn"  @guest href="{{route('weblogin')}}" @endguest @auth href="{{route('logout')}}" @endauth>
            <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1" style="height: 22px;">
                <path d="M7 13H23.8" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                <path d="M20.8 8.7998L25 12.9998L20.8 17.1998" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                <path d="M15.4 17.8V22.6C15.4 23.2365 15.1471 23.847 14.6971 24.2971C14.247 24.7471 13.6365 25 13 25H3.4C2.76348 25 2.15303 24.7471 1.70294 24.2971C1.25286 23.847 1 23.2365 1 22.6V3.4C1 2.76348 1.25286 2.15303 1.70294 1.70294C2.15303 1.25286 2.76348 1 3.4 1H13C13.6365 1 14.247 1.25286 14.6971 1.70294C15.1471 2.15303 15.4 2.76348 15.4 3.4V8.2" stroke="white" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"/>
            </svg>
            <u>@guest Login @endguest @auth Logout @endauth</u>
        </a>

    </div>
    <nav class="menu">
        <div class="icon-list">
            <a href="#" link-type="sc_visit" class="userAccess" data-href="{{route('services-schedule-visit')}}">Request a Service</a>
            <a href="#" link-type="calendar" class="userAccess" data-href="{{route('calender-calendar')}}">Calendar</a>
            <a href="#" link-type="connect" class="userAccess" data-href="{{route('connect-connect')}}">Connect</a>
            @auth
            @if(auth()->user()->roles->first()->id != 3)
            <a href="{{route('my-activity')}}">My Activity</a>
            @endif


            @if(auth()->user()->roles->first()->id == '1' || auth()->user()->roles->first()->id == '5')
            <a href="#" class="adminmenu-link" >Admin Services</a>
            @endif
            @endauth

            <a href="#" link-type="helpp" class="userAccess" data-href="{{ route('help-submit-request') }}">Help</a>
            <a href="{{route('faq')}}">FAQ</a>
            @auth
            @if(auth()->user()->roles->first()->id != 3)
                <a href="{{route('notification-index')}}">Notifications</a>
            @endif
            @endauth
            <!-- <a href="#">Settings</a> -->
        </div>
        <div class="sub-icon-list">
            <div class="adminmenu-back" >
                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.36444 8.77182L10.0876 1.17542L8.89419 0L0 8.7762L8.89419 17.5436L10.0876 16.3682L2.36444 8.77182Z" fill="white"/>
                </svg>
            </div>
            @auth
            @if(auth()->user()->roles->first()->id == '1')
            <a href="{{ route('admin-aboutlab-pages') }}">CMS</a>
            @endif
            @endauth
            <a href="{{ route('services-admin-schedule-visit-list') }}">Manage Services</a>
            <a href="{{route('user-control-general')}}">User Control</a>
            <a href="{{route('users_list')}}">User Profiles</a>
            <a href="{{ route('calender-admin-event-management') }}">Event Management</a>
            <a href="{{route('feedback-admin-index')}}">Feedback Management</a>
            <a href="{{route('help-admin-help-system-management')}}">Help System Mangement</a>
            <a href="{{route('notification-admin-pushNotification')}}">Notification Management</a>
            <a href="{{route('profile_list')}}">Profile Completion</a>
            <a href="{{ route('calender-admin-create') }}">Calendar Management</a>
            <a href="{{ route('services-admin-cancel-schedule-visit-list') }}">Cancellation Request Management</a>
        </div>
    </nav>

    <div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
            <defs>
                <linearGradient id="myGradient" gradientTransform="rotate(90)">
                    <stop stop-color="#00A3E0" offset="0%"></stop>
                    <stop stop-color="#00A3E0" offset="24%"></stop>
                    <stop stop-color="#00A3E0" offset="35%"></stop>
                    <stop stop-color="#00A3E0" offset="100%"></stop>
                </linearGradient>
                </defs>
            <path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z" fill="url('#myGradient')"/>
        </svg>
    </div>
</div>
<div class="side-nav-backdrop"></div>
<script>
    var accessUrl = "{{route('giveAccessToUser')}}";
    var loginUrl = "{{route('index')}}";
</script>
