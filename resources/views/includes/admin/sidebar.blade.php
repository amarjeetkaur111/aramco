     <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <!-- <a href="{{route('admin-dashboard')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img width="40" src="{{ asset('assets/img/logo.jpg') }}" />
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">aramco</span>
            </a> -->

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block" onclick="closeNav()">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Back to User site -->
            <li class="menu-item @if(Route::is('index')) active @endif">
              <a href="{{route('index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-globe"></i>
                <div data-i18n="Analytics">Back to Website</div>
              </a>
            </li>
            <!-- Dashboard -->
            <!-- <li class="menu-item @if(Route::is('admin-dashboard')) active @endif">
              <a href="{{route('admin-dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li> -->

            <!-- Users -->
             <li class="menu-item @if(Route::is('admin-users-index') || Route::is('admin-roles-index')) active open @endif ">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Layouts">User Management</div>
              </a>

             <ul class="menu-sub">
                {{-- <li class="menu-item @if(Route::is('admin-users-pending-requests')) active @endif ">
                  <a href="{{route('admin-users-pending-requests')}}" class="menu-link">
                    <div data-i18n="Without menu">Profile Completion Requests</div>
                  </a>
                </li> --}}
                <li class="menu-item @if(Route::is('admin-users-index')) active @endif ">
                  <a href="{{route('admin-users-index')}}" class="menu-link">
                    <div data-i18n="Without menu">Users</div>
                  </a>
                </li>
                 {{-- <li class="menu-item @if(Route::is('admin-roles-index')) active @endif ">
                  <a href="{{route('admin-roles-index')}}" class="menu-link">
                    <div data-i18n="Without navbar">Roles</div>
                  </a>
                </li> --}}
              </ul>
            </li>



            <li class="menu-item @if(Route::is('admin-aboutlab-*') || Route::is('admin-faqs-*') || Route::is('admin-ar-*'))  active open @endif ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-book-content"></i>
                  <div data-i18n="Layouts">Content Management</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item @if(Route::is('admin-aboutlab-*')) active  @endif ">
                    <a href="{{route('admin-aboutlab-pages')}}" class="menu-link">
                      <div data-i18n="Without menu">About the Lab</div>
                    </a>
                  </li>

                  <li class="menu-item @if(Route::is('admin-faqs-*')) active  @endif ">
                    <a href="{{route('admin-faqs-all')}}" class="menu-link">
                      <div data-i18n="Without menu">FAQs</div>
                    </a>
                  </li>


                  <li class="menu-item @if(Route::is('admin-ar-*')) active  @endif ">
                    <a href="{{route('admin-ar-all')}}" class="menu-link">
                      <div data-i18n="Without menu">AR navigation</div>
                    </a>
                  </li>

                </ul>
              </li>

              <!-- Services -->
{{--              <li class="menu-item @if(Request::is('admin/service/*')) active open @endif ">--}}
{{--                  <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
{{--                      <i class="menu-icon tf-icons bx bx-layout"></i>--}}
{{--                      <div data-i18n="Layouts">Services</div>--}}
{{--                  </a>--}}

{{--                  <ul class="menu-sub">--}}
{{--                      <li class="menu-item @if(Route::is('admin-service-resource-list') || Route::is('admin-service-resource-*')) active @endif ">--}}
{{--                          <a href="{{ route('admin-service-resource-index') }}" class="menu-link">--}}
{{--                              <div data-i18n="Without menu">Resources Request</div>--}}
{{--                          </a>--}}
{{--                      </li>--}}
{{--                      <li class="menu-item @if(Route::is('admin-service-visit-list') || Route::is('admin-service-visit-*')) active @endif ">--}}
{{--                          <a href="{{ route('admin-service-visit-index') }}" class="menu-link">--}}
{{--                              <div data-i18n="Without menu">Visit Request</div>--}}
{{--                          </a>--}}
{{--                      </li>--}}
{{--                  </ul>--}}
{{--              </li>--}}


              <!-- 2nd leavel sub menu -->
              {{-- <li class="menu-item @if(Request::is('admin/service/*')) active open @endif ">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-layout"></i>
                      <div data-i18n="Layouts">Services</div>
                  </a>

                  <ul class="menu-sub">
                      <li class="menu-item @if(Route::is('admin-service-visit-list') || Route::is('admin-service-visit-*')) active @endif ">
                          <a href="{{ route('admin-service-visit-index') }}" class="menu-link">
                              <div data-i18n="Without menu">Visit Request</div>
                          </a>
                      </li>

                      <li class="menu-item @if(Route::is('admin-service-resource-list') || Route::is('admin-service-resource-*')) active @endif ">
                        <a href="{{ route('admin-service-resource-index') }}" class="menu-link">
                            <div data-i18n="Without menu">Resources Request</div>
                        </a>
                      </li>

                      <li class="menu-item @if(Route::is('admin-service-workshop-request-list') || Route::is('admin-service-workshop-request-*')) active @endif ">
                          <a href="{{ route('admin-service-workshop-request-index') }}" class="menu-link">
                              <div data-i18n="Without menu">Workshop Request</div>
                          </a>
                      </li>

                      <li class="menu-item @if(Route::is('admin-service-general-reservation-list') || Route::is('admin-service-general-reservation-*')) active @endif ">
                          <a href="{{ route('admin-service-general-reservation-index') }}" class="menu-link">
                              <div data-i18n="Without menu">General Reservation</div>
                          </a>
                      </li>


                      <li class="menu-item @if(Route::is('admin-service-required-resources-*') ||  Route::is('admin-service-event-request-*')) active open @endif ">
                          <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="sub menu">Event Request</div>
                          </a>

                          <ul class="menu-sub">
                              <li class="menu-item @if(Route::is('admin-service-event-request-index') || Route::is('admin-service-event-request-*')) active @endif ">
                                  <a href="{{ route('admin-service-event-request-index') }}" class="menu-link">
                                      <div data-i18n="Without menu">Event Request List</div>
                                  </a>
                              </li>
                              <li class="menu-item @if(Route::is('admin-service-required-resources-index') || Route::is('admin-service-required-resources-*')) active @endif ">
                                  <a href="{{ route('admin-service-required-resources-index') }}" class="menu-link">
                                      <div data-i18n="Without menu">Required Resource</div>
                                  </a>
                              </li>
                          </ul>

                      </li>
                      <li class="menu-item @if(Route::is('admin-service-incubator-request') || Route::is('admin-service-incubator-request-*')) active @endif ">
                          <a href="{{ route('admin-service-incubator-request-index') }}" class="menu-link">
                              <div data-i18n="Without menu">Incubator Request</div>
                          </a>

                      <li class="menu-item @if(Route::is('admin-service-implementation-level-*') || Route::is('admin-service-technology-*') || Route::is('admin-service-idea-request-*')) active open @endif ">
                          <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="sub menu">Idea Request</div>
                          </a>

                          <ul class="menu-sub">
                              <li class="menu-item @if(Route::is('admin-service-idea-request-index') || Route::is('admin-service-idea-request-*')) active @endif ">
                                  <a href="{{ route('admin-service-idea-request-index') }}" class="menu-link">
                                      <div data-i18n="Without menu">Idea Request List</div>
                                  </a>
                              </li>
                              <li class="menu-item @if(Route::is('admin-service-technology-index') || Route::is('admin-service-technology-*')) active @endif ">
                                  <a href="{{ route('admin-service-technology-index') }}" class="menu-link">
                                      <div data-i18n="Without menu">Technology</div>
                                  </a>
                              </li>
                              <li class="menu-item @if(Route::is('admin-service-implementation-level-index') || Route::is('admin-service-implementation-level-*')) active @endif ">
                                  <a href="{{ route('admin-service-implementation-level-index') }}" class="menu-link">
                                      <div data-i18n="Without menu">Implementation Level</div>
                                  </a>
                              </li>
                          </ul>

                      </li>
                  </ul>
              </li> --}}



            <!-- Layouts -->
{{--            <li class="menu-item">--}}
{{--              <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
{{--                <i class="menu-icon tf-icons bx bx-layout"></i>--}}
{{--                <div data-i18n="Layouts">Layouts</div>--}}
{{--              </a>--}}

{{--              <ul class="menu-sub">--}}
{{--                <li class="menu-item">--}}
{{--                  <a href="layouts-without-menu.html" class="menu-link">--}}
{{--                    <div data-i18n="Without menu">Without menu</div>--}}
{{--                  </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                  <a href="layouts-without-navbar.html" class="menu-link">--}}
{{--                    <div data-i18n="Without navbar">Without navbar</div>--}}
{{--                  </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                  <a href="layouts-container.html" class="menu-link">--}}
{{--                    <div data-i18n="Container">Container</div>--}}
{{--                  </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                  <a href="layouts-fluid.html" class="menu-link">--}}
{{--                    <div data-i18n="Fluid">Fluid</div>--}}
{{--                  </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                  <a href="layouts-blank.html" class="menu-link">--}}
{{--                    <div data-i18n="Blank">Blank</div>--}}
{{--                  </a>--}}
{{--                </li>--}}
{{--              </ul>--}}
{{--            </li>--}}


          </ul>
        </aside>
        <!-- / Menu -->
        <script>
            function closeNav() {
      console.log('closeNav')
      console.log(document.getElementById("side-html"))
      console.log('hamMenu',document.getElementById("hamMenu"))
      document.getElementById("layout-menu").style.width = "0";
      document.getElementById("layout-menu").style.display = "none";
      document.getElementById("side-html").style.paddingLeft = "0";
      document.getElementById("hamMenu").style.display = "block";


    }


        </script>

