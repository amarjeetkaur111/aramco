<link href="{{asset('assets/web/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco-base.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/menu_elastic.css')}}" rel="stylesheet" />
<script src="{{asset('assets/web/js/snap.svg-min.js')}}"></script>
<link href="{{asset('assets/web/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/plugins/select2/css/select2-bootstrap-5-theme.css')}}" rel="stylesheet" />
</head>

<body>



     <!-- Spinner -->
     <div class="overlay" id="spinner" style="display:none;">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
    <div class="main-container">
        <!-- add 'home-page' class to 'main' only if its home page for top padding on other pages-->
        <main class="main">

            <!--  'header--light' class to 'header' only if its home page otherwise switch to 'header--dark' class -->
            <!-- <header class="header header--light" id="site-header"> -->
            <header class="header header--dark" id="site-header">
                <a href="{{route('index')}}" class="header__logo">
                    D&IT Lab Excellence
                </a>
                <!-- <div class="container header__components"> -->
                <div class="header__components">
                    <div class="header__component-toggle " style="flex-wrap:nowrap;">
                        <button type="button" class="toggle-navigation" id="open-button">
                            <span class="line-1"></span>
                            <span class="line-2"></span>
                            <span class="line-3"></span>
                        </button>
                    </div>

                    <div class="topic-navigation" >
                        <ul class="topic-navigation__list">
                            <li><a href="#" link-type="sc_visit" class="userAccess" data-href="{{route('services-schedule-visit')}}">Request a service</a></li>
                            <li><a href="#" link-type="calendar" class="userAccess" data-href="{{route('calender-calendar')}}">Calendar</a></li>
                            <li><a href="#" link-type="connect" class="userAccess" data-href="{{route('connect-connect')}}">Connect</a></li>
                            <li><a href="{{ !empty(auth()->user()) ? (auth()->user()->roles->first()->id != 3) ? route('my-activity') : 'javascript:void(0)' : 'javascript:void(0)' }}">My Activity</a></li>
                        </ul>
                    </div>

                    <div class="header__component-collection" style="flex-wrap:nowrap;">
                        <div class="header__avatar d-flex">
                            <!-- Switch display of bellow buttons for login and profile -->
                            @guest
                            <a href="{{route('weblogin')}}" class="btn header__avatar-button-login " title="login">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.5455 13.5652H5.45455C4.0084 13.5667 2.62194 14.1169 1.59935 15.095C0.576772 16.0732 0.00158814 17.3993 0 18.7826L0 22.9565C0 23.2333 0.114935 23.4987 0.31952 23.6944C0.524105 23.8901 0.801582 24 1.09091 24C1.38024 24 1.65771 23.8901 1.8623 23.6944C2.06688 23.4987 2.18182 23.2333 2.18182 22.9565V18.7826C2.18268 17.9526 2.52777 17.1569 3.14133 16.57C3.7549 15.9831 4.58683 15.653 5.45455 15.6522H18.5455C19.4132 15.653 20.2451 15.9831 20.8587 16.57C21.4722 17.1569 21.8173 17.9526 21.8182 18.7826V22.9565C21.8182 23.2333 21.9331 23.4987 22.1377 23.6944C22.3423 23.8901 22.6198 24 22.9091 24C23.1984 24 23.4759 23.8901 23.6805 23.6944C23.8851 23.4987 24 23.2333 24 22.9565V18.7826C23.9984 17.3993 23.4232 16.0732 22.4006 15.095C21.3781 14.1169 19.9916 13.5667 18.5455 13.5652ZM12 12.5217C13.2946 12.5217 14.5601 12.1545 15.6365 11.4666C16.7129 10.7786 17.5518 9.80083 18.0472 8.6568C18.5426 7.51278 18.6722 6.25393 18.4197 5.03944C18.1671 3.82495 17.5437 2.70937 16.6283 1.83377C15.7129 0.958171 14.5466 0.361881 13.277 0.120304C12.0073 -0.121273 10.6912 0.00271275 9.49516 0.476583C8.29914 0.950454 7.27688 1.75292 6.55765 2.78252C5.83843 3.81211 5.45455 5.02259 5.45455 6.26087C5.45642 7.92081 6.14663 9.51224 7.37374 10.686C8.60084 11.8597 10.2646 12.5199 12 12.5217M12 2.08696C12.863 2.08696 13.7067 2.33176 14.4243 2.79039C15.1419 3.24903 15.7012 3.9009 16.0315 4.66359C16.3617 5.42627 16.4482 6.2655 16.2798 7.07516C16.1114 7.88482 15.6958 8.62854 15.0856 9.21227C14.4753 9.79601 13.6978 10.1935 12.8513 10.3546C12.0048 10.5156 11.1275 10.433 10.3301 10.1171C9.53276 9.80115 8.85125 9.26617 8.37177 8.57977C7.89229 7.89338 7.63636 7.08639 7.63636 6.26087C7.63766 5.15426 8.09782 4.09333 8.91588 3.31084C9.73394 2.52835 10.8431 2.0882 12 2.08696" fill="white" />
                                </svg>
                            </a>
                            @endguest

                            @auth
                            <a href="{{route('user-profile')}}" class="btn header__avatar-button-profile profileAlert " title="profile">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.4844 13.5937C19.4844 14.5796 19.192 15.5432 18.6444 16.3629C18.0967 17.1826 17.3182 17.8215 16.4074 18.1987C15.4967 18.576 14.4945 18.6747 13.5276 18.4824C12.5607 18.29 11.6726 17.8153 10.9755 17.1182C10.2784 16.4212 9.80373 15.533 9.6114 14.5662C9.41908 13.5993 9.51779 12.5971 9.89504 11.6863C10.2723 10.7755 10.9112 9.99708 11.7308 9.44939C12.5505 8.9017 13.5142 8.60937 14.5 8.60937C15.8215 8.61087 17.0884 9.13649 18.0228 10.0709C18.9573 11.0053 19.4829 12.2723 19.4844 13.5937ZM26.2813 14.5C26.2813 16.8301 25.5903 19.1079 24.2958 21.0453C23.0012 22.9827 21.1612 24.4928 19.0085 25.3845C16.8558 26.2761 14.4869 26.5095 12.2016 26.0549C9.91626 25.6003 7.81704 24.4782 6.1694 22.8306C4.52177 21.183 3.39971 19.0837 2.94513 16.7984C2.49055 14.5131 2.72385 12.1443 3.61555 9.99151C4.50724 7.83877 6.01728 5.99879 7.95469 4.70425C9.89211 3.40971 12.1699 2.71875 14.5 2.71875C17.6236 2.72205 20.6183 3.96434 22.827 6.17304C25.0357 8.38174 26.278 11.3764 26.2813 14.5ZM24.4688 14.5C24.4673 13.1582 24.1953 11.8305 23.6689 10.5963C23.1426 9.36205 22.3727 8.24664 21.4054 7.31676C20.4381 6.38688 19.2932 5.66163 18.0392 5.18439C16.7851 4.70714 15.4477 4.48769 14.1069 4.53918C8.77137 4.74535 4.51653 9.18937 4.53126 14.5283C4.53637 16.9588 5.43277 19.303 7.05063 21.1168C7.7095 20.1611 8.54644 19.3415 9.51563 18.7027C9.59826 18.6482 9.6965 18.6222 9.79531 18.6287C9.89412 18.6352 9.98807 18.674 10.0628 18.739C11.2943 19.8042 12.8683 20.3905 14.4966 20.3905C16.1249 20.3905 17.6989 19.8042 18.9304 18.739C19.0051 18.674 19.0991 18.6352 19.1979 18.6287C19.2967 18.6222 19.395 18.6482 19.4776 18.7027C20.448 19.3412 21.2861 20.1608 21.946 21.1168C23.5718 19.2964 24.47 16.9407 24.4688 14.5Z" fill="white" />
                                </svg>
                                <!-- for profile alert exclamations add 'profileAlert' class for 'header__avatar-button-profile' button class -->
                                @if(auth()->user()->roles->first()->id == '3')
                                <svg width="2" height="14" viewBox="0 0 2 14" fill="#FFC846" class="pAlert" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.999956 0.5C1.21213 0.5 1.41561 0.596116 1.56564 0.767204C1.71567 0.938292 1.79996 1.17034 1.79996 1.41229V8.71063C1.79996 8.95258 1.71567 9.18463 1.56564 9.35572C1.41561 9.52681 1.21213 9.62292 0.999956 9.62292C0.787781 9.62292 0.584297 9.52681 0.434267 9.35572C0.284237 9.18463 0.199951 8.95258 0.199951 8.71063V1.41229C0.199951 1.17034 0.284237 0.938292 0.434267 0.767204C0.584297 0.596116 0.787781 0.5 0.999956 0.5Z" fill="#FFC846" />
                                    <path d="M1 11.2192C1.13144 11.2189 1.2616 11.2486 1.38275 11.3068C1.5039 11.3649 1.61356 11.4503 1.7052 11.5577C1.79865 11.6639 1.87279 11.7901 1.92337 11.929C1.97396 12.068 2 12.2169 2 12.3674C2 12.5178 1.97396 12.6668 1.92337 12.8057C1.87279 12.9446 1.79865 13.0708 1.7052 13.177C1.51541 13.3843 1.26278 13.5 1 13.5C0.73722 13.5 0.484586 13.3843 0.294796 13.177C0.201355 13.0708 0.127216 12.9446 0.0766286 12.8057C0.026041 12.6668 0 12.5178 0 12.3674C0 12.2169 0.026041 12.068 0.0766286 11.929C0.127216 11.7901 0.201355 11.6639 0.294796 11.5577C0.386472 11.4503 0.496135 11.365 0.617276 11.3069C0.738418 11.2487 0.868568 11.2189 1 11.2192Z" fill="#FFC846" />
                                </svg>
                                @endif
                            </a>
                            @endauth

                        </div>
                        <div class="header__search">
                            <button type="button" class="logo-search" data-bs-toggle="modal" data-bs-target=".search-fullscreen-modal">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6 20.2C15.9019 20.2 20.2 15.9019 20.2 10.6C20.2 5.29807 15.9019 1 10.6 1C5.29807 1 1 5.29807 1 10.6C1 15.9019 5.29807 20.2 10.6 20.2Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M25 24.9999L17.734 17.7339" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                                </svg>

                            </button>
                        </div>
                    </div>

            </header>




@php
$usersD = Auth()->id();
$roleUser = getRoleName($usersD);

@endphp
            <script>


                function globalSearch(keyword) {
                    var UserRole = "{{trim($roleUser)}}";
                    // alert(UserRole)
                    console.log(UserRole);
                    var results = [];
                    results.splice(0, results.length);

                    var myArray = ['Admin','Super Admin'];
                    var index =  $.inArray(UserRole, myArray);

                    var manage_service_value = '';
                    var user_control_value = '';
                    var user_profile_value = '';
                    var event_management_value = '';
                    var feedback_management_value = '';
                    var help_system_value = '';
                    var notification_management_value = '';
                    var profile_completion_value = '';
                    var calander_management_value = '';
                    var cancellation_request_value = '';





                    var manage_service_key = "";
                    var user_control_key = "";
                    var user_profile_key = "";
                    var event_management_key = "";
                    var feedback_management_key = "";
                    var help_system_key = '';
                    var notification_management_key = '';
                    var profile_completion_key = '';
                    var calander_management_key = '';
                    var cancellation_request_key = '';



                    var  my_Scheduled_visits_key= "My Scheduled visits";
                    var  my_activity_key= "My Activity";
                    var  my_host_event_key= "My Hosted Events";
                    var  my_allocating_key= "My Allocated Computing Resources";
                    var  my_incubator_key= "My Reserved Incubator";
                    var  my_tech_key= "My Reserved Technology Workshop";
                    var  my_idea_key= "My Submitted idea";
                    var  my_general_key= "My General Reservation";
                    var  connectSystem_key= "Connect";
                    var  calendar_key= "Calendar";
                    var  help_key= "Help";
                    if(UserRole !=null){
                        if(index !== -1){
                            var manage_service_key = "Manage services";
                            var user_control_key = "User Control";
                            var user_profile_key = "User Profile";
                            var event_management_key = "Event Management";
                            var feedback_management_key = "Feedback Management";
                            var help_system_key = "Help System Management";
                            var notification_management_key = "Notification Management";
                            var profile_completion_key = "Profile Completion";
                            var calander_management_key = "Calendar Management";
                            var cancellation_request_key = "Cancellation Request Management";
                        }
                    }
                    // alert(manage_service_key);





                    var schedule_visit='<a  href="{{route("services-my-schedule-visits-index")}}" ><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/event-schedule.svg")}}" class="img-fluid" /></div><div class="stext">My Scheduled visits</div></div></a>';
                    var my_activity = '<a  href="{{route("my-activity")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/my-activity.svg")}}" class="img-fluid" /></div><div class="stext">My Activity</div></div></a>';
                    var my_host_event = '<a href="{{route("services-my-hosted-events-index")}}" ><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/host-an-event.svg")}}" class="img-fluid" /></div><div class="stext">My Hosted Event</div></div></a>';
                    var my_allocating = '<a  href="{{route("services-my-alocating-computing-events-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/allocate-computing-resources.svg")}}" class="img-fluid" /></div><div class="stext">My Allocated Computing Resources</div></div></a>';
                    var my_incubator = '<a  href="{{route("services-my-reserve-incubator-events-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/reserve-incubator.svg")}}" class="img-fluid" /></div><div class="stext">My Reserved Incubator</div></div></a>';
                    var my_tech = '<a  href="{{route("services-my-reserve-tech-events-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/reserve-technology-workshop.svg")}}" class="img-fluid" /></div><div class="stext">My Reserved Technology Workshop</div></div></a>';
                    var my_idea = '<a  href="{{route("services-my-submit-idea-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/submit-an-idea.svg")}}" class="img-fluid" /></div><div class="stext">My Submitted idea</div></div></a>';
                    var my_general = '<a  href="{{route("services-my-general-reservation-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/general-service.svg")}}" class="img-fluid" /></div><div class="stext">My General Reservation</div></div></a>';
                    var connectSystem = '<a link-type="connect" class="userAccess" data-href="{{route("connect-connect")}}" href="#"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/general-service.svg")}}" class="img-fluid" /></div><div class="stext">Connect</div></div></a>';
                    var calendar = '<a link-type="calendar" class="userAccess" data-href="{{route("calender-calendar")}}" href="#"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/calendar.svg")}}" class="img-fluid" /></div><div class="stext">Calendar</div></div></a>';
                    var help = '<a link-type="helpp" class="userAccess" data-href="{{ route("help-submit-request") }}" href="#"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Help</div></div></a>';
                    if(index !== -1){
                        var manage_service_value = '<a href="{{route("services-admin-schedule-visit-list")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Manage Services</div></div></a>';
                        var user_control_value = '<a href="{{route("user-control-general")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">User Control</div></div></a>';
                        var user_profile_value = '<a href="{{route("users_list")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">User Profile</div></div></a>';
                        var event_management_value = '<a href="{{route("calender-admin-event-management")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Event Management</div></div></a>';
                        var feedback_management_value = '<a href="{{route("feedback-admin-index")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Feedback Management</div></div></a>';
                        var help_system_value = '<a href="{{route("help-submit-request")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Help System Management</div></div></a>';
                        var notification_management_value = '<a href="{{route("notification-admin-pushNotification")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Notification Management</div></div></a>';
                        var profile_completion_value = '<a href="{{route("profile_list")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Profile Completion</div></div></a>';
                        var calander_management_value = '<a href="{{route("calender-admin-create")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Calendar Management</div></div></a>';
                        var cancellation_request_value = '<a href="{{route("services-admin-cancel-schedule-visit-list")}}"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">Cancellation Request Management</div></div></a>';
                    }
                    // else{
                    //     var manage_service_value = '';
                    // }
                    // if(UserRole =='Admin' || 'Super Admin'){
                    //     var user_control_value = '<a href="#"><div class="row search_wrapper_small_heading"><div class="sicon"><img src="{{asset("assets/web/images/icons/24/edit.svg")}}" class="img-fluid" /></div><div class="stext">User Control</div></div></a>';
                    // }
                    // else{
                    //     var user_control_value = '';
                    // }
                    var data = {
                        my_Scheduled_visits_key: schedule_visit,
                        my_host_event_key: my_host_event,
                        my_activity_key: my_activity,
                        my_allocating_key: my_allocating,
                        my_incubator_key: my_incubator,
                        my_tech_key: my_tech,
                        my_idea_key: my_idea,
                        my_general_key: my_general,
                        calendar_key: calendar,
                        connectSystem_key: connectSystem,
                        help_key: help,
                        manage_service_key: manage_service_value,
                        user_control_key: user_control_value,
                        user_profile_key: user_profile_value,
                        // user_profile_key: user_profile_value,
                        event_management_key: event_management_value,
                        feedback_management_key: feedback_management_value,
                        help_system_key: help_system_value,
                        notification_management_key: notification_management_value,
                        profile_completion_key: profile_completion_value,
                        calander_management_key: calander_management_value,
                        cancellation_request_key: cancellation_request_value,
                    };

    //   console.log(data);
            keyword = keyword.toLowerCase(); // Convert input to lowercase for case-insensitive search
            var  final_res="";
            if (keyword.trim() === "") {
                results.splice(0, results.length);
                document.getElementById("results___").innerHTML = "";

            }else{


            for (var key in data) {
                if (key.toLowerCase().indexOf(keyword) !== -1) {
                    // results.push(data[key]);
                      final_res += data[key];

                }
            }
        }


            if (final_res.length >= 0) {
                // console.log( results.join("<br>"));
                // alert('one');

                document.getElementById("results___").innerHTML = final_res;
                console.log( final_res);

            } else {
                // alert('two');

                console.log("No results found for key: " + keyword);
                document.getElementById("results___").innerHTML = "No results found for key: " + keyword;
            }


                }
            </script>
