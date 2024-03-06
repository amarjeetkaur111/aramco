<div class="modal fade search-fullscreen-modal">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="border-bottom pb-4">
        <div class="container">
          <div class="modal-header border-0">
            <h2 class="search__modal-logo text-center flex-grow-1">D&IT Lab Excellence</h2>
            <button type="button" class="search__modal-close-button" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" focusable="false" width="31" height="31" viewBox="0 0 31 31">
                    <g fill="none" fill-rule="evenodd">
                        <g fill="#00A3E0">
                            <path d="M9.545 0H11.454V21H9.545z" transform="rotate(-45 19.036 6.964)"></path>
                            <path d="M9.545 0L11.455 0 11.455 21 9.545 21z" transform="rotate(-45 19.036 6.964) rotate(90 10.5 10.5)"></path>
                        </g>
                    </g>
                </svg>
                <span>Close</span>
            </button>
          </div>
          <div class="search__wrapper__small">
            <div class="input-group search__input">
              <span class="input-group-text bg-transparent border-0">
                <svg xmlns="http://www.w3.org/2000/svg" focusable="false" width="25" height="25" viewBox="0 0 25 25">
                    <g fill="#C0C0C0" fill-rule="evenodd">
                        <path d="M1.641 9.85c0-4.527 3.683-8.209 8.209-8.209s8.209 3.682 8.209 8.209c0 4.526-3.683 8.208-8.21 8.208-4.525 0-8.208-3.682-8.208-8.208zm22.98 13.61l-7.254-7.254c1.454-1.717 2.334-3.936 2.334-6.356 0-5.432-4.42-9.85-9.851-9.85C4.419 0 0 4.418 0 9.85c0 5.432 4.419 9.85 9.85 9.85 2.421 0 4.64-.879 6.356-2.334l7.254 7.255 1.16-1.16z"></path>
                    </g>
                </svg>
              </span>
              <input type="text" class="form-control bg-transparent border-0 searchBoxInput" placeholder="Search Here" onkeyup="globalSearch(this.value)">
              <button class="btn btn-outline-secondary bg-transparent border-0" type="button" id="searchClose">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.5947 7.3555C17.4072 7.16803 17.1529 7.06271 16.8877 7.06271C16.6225 7.06271 16.3682 7.16803 16.1807 7.3555L12.8877 10.6485L9.5947 7.3555C9.4061 7.17334 9.15349 7.07255 8.8913 7.07482C8.6291 7.0771 8.37829 7.18227 8.19288 7.36768C8.00747 7.55309 7.9023 7.8039 7.90002 8.0661C7.89775 8.32829 7.99854 8.5809 8.1807 8.7695L11.4737 12.0625L8.1807 15.3555C8.08519 15.4477 8.00901 15.5581 7.9566 15.6801C7.90419 15.8021 7.8766 15.9333 7.87545 16.0661C7.87429 16.1989 7.8996 16.3306 7.94988 16.4534C8.00016 16.5763 8.07441 16.688 8.1683 16.7819C8.2622 16.8758 8.37385 16.95 8.49674 17.0003C8.61964 17.0506 8.75132 17.0759 8.8841 17.0747C9.01688 17.0736 9.1481 17.046 9.2701 16.9936C9.39211 16.9412 9.50245 16.865 9.5947 16.7695L12.8877 13.4765L16.1807 16.7695C16.3693 16.9517 16.6219 17.0525 16.8841 17.0502C17.1463 17.0479 17.3971 16.9427 17.5825 16.7573C17.7679 16.5719 17.8731 16.3211 17.8754 16.0589C17.8776 15.7967 17.7769 15.5441 17.5947 15.3555L14.3017 12.0625L17.5947 8.7695C17.7822 8.58197 17.8875 8.32766 17.8875 8.0625C17.8875 7.79733 17.7822 7.54303 17.5947 7.3555ZM12.8877 0.0625C10.5143 0.0625 8.19425 0.766288 6.22086 2.08486C4.24747 3.40344 2.7094 5.27758 1.80115 7.4703C0.892895 9.66301 0.655255 12.0758 1.11828 14.4036C1.5813 16.7314 2.72419 18.8695 4.40242 20.5478C6.08065 22.226 8.21884 23.3689 10.5466 23.8319C12.8744 24.2949 15.2872 24.0573 17.4799 23.149C19.6726 22.2408 21.5468 20.7027 22.8653 18.7293C24.1839 16.756 24.8877 14.4359 24.8877 12.0625C24.8843 8.88096 23.6189 5.83071 21.3692 3.58102C19.1195 1.33133 16.0692 0.0659411 12.8877 0.0625ZM12.8877 22.0625C10.9099 22.0625 8.97649 21.476 7.332 20.3772C5.68751 19.2784 4.40578 17.7166 3.6489 15.8893C2.89203 14.0621 2.694 12.0514 3.07985 10.1116C3.4657 8.17179 4.41811 6.38996 5.81663 4.99143C7.21516 3.59291 8.99699 2.6405 10.9368 2.25465C12.8766 1.86879 14.8873 2.06683 16.7145 2.8237C18.5418 3.58058 20.1036 4.86231 21.2024 6.5068C22.3012 8.15129 22.8877 10.0847 22.8877 12.0625C22.8848 14.7138 21.8303 17.2556 19.9555 19.1303C18.0808 21.0051 15.539 22.0596 12.8877 22.0625Z" fill="#C0C0C0"/>
                </svg>
              </button>
            </div>
          </div>

        </div>
      </div>
      
      <div class="modal-body mt-4">
        <div class="container">
          <div class="search__wrapper__small px-sm-4 px-0" id="results___">

          <!-- <div class="search_wrapper_small_heading">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/request-service.svg')}}" class="img-fluid" /></div><div class="stext">Request a Service</div>
          </div> -->

          <!-- <div class="search_wrapper_small_heading">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/my-activity.svg')}}" class="img-fluid" /></div><div class="stext">My Activity</div>
          </div> -->

          <!-- List list search results -->
          <!-- <ul class="list-unstyled">
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule.svg')}}" class="img-fluid" /></div><div class="stext">Schedule a visit</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li>
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></div><div class="stext">Host an Event</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li>
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></div><div class="stext">Allocate Computing Resources</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li>
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Incubator</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li> 
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Technology Workshop</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li>
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></div><div class="stext">Submit an Idea</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li> 
              <li><a class="search_wrapper_small_link" href="#">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/general-service.svg')}}" class="img-fluid" /></div><div class="stext">General Service</div><div class="sarrow"><img src="{{asset('assets/web/images/icons/24/arrow-right.svg')}}" class="img-fluid" /></div>
              </a></li> 
          </ul> -->


          <!-- accordian list search results -->


          <!-- <div class="accordion search_accordion" id="search_accordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="sh1">
                <button class="accordion-button search_wrapper_small_link" type="button" data-bs-toggle="collapse" data-bs-target="#s1" aria-controls="s1">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule.svg')}}" class="img-fluid" /></div><div class="stext">My Scheduled visits</div>
                </button>
              </h2>
              <div id="s1" class="accordion-collapse collapse show" aria-labelledby="sh1" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="sh2">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s2" aria-expanded="false" aria-controls="s2">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></div><div class="stext">My Hosted Event</div>
                </button>
              </h2>
              <div id="s2" class="accordion-collapse collapse" aria-labelledby="sh2" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/host-an-event-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/host-an-event-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="sh3">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s3" aria-expanded="false" aria-controls="s3">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></div><div class="stext">My Allocated Computing Resources</div>
                </button>
              </h2>
              <div id="s3" class="accordion-collapse collapse" aria-labelledby="sh3" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="accordion-item">
              <h2 class="accordion-header" id="sh4">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s4" aria-expanded="false" aria-controls="s4">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></div><div class="stext">My Reserved Incubator</div>
                </button>
              </h2>
              <div id="s4" class="accordion-collapse collapse" aria-labelledby="sh4" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/reserve-incubator-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/reserve-incubator-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="sh5">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s5" aria-expanded="false" aria-controls="s5">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></div><div class="stext">My Reserved Technology Workshop</div>
                </button>
              </h2>
              <div id="s5" class="accordion-collapse collapse" aria-labelledby="sh5" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="sh6">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s6" aria-expanded="false" aria-controls="s6">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></div><div class="stext">My Submitted Idea</div>
                </button>
              </h2>
              <div id="s6" class="accordion-collapse collapse" aria-labelledby="sh6" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/submit-an-idea-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/submit-an-idea-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="sh7">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s7" aria-expanded="false" aria-controls="s7">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/add-to-calender.svg')}}" class="img-fluid" /></div><div class="stext">My Event participation</div>
                </button>
              </h2>
              <div id="s7" class="accordion-collapse collapse" aria-labelledby="sh7" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/add-to-calender-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/add-to-calender-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="sh8">
                <button class="accordion-button search_wrapper_small_link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s8" aria-expanded="false" aria-controls="s8">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/general-service.svg')}}" class="img-fluid" /></div><div class="stext">General Service</div>
                </button>
              </h2>
              <div id="s8" class="accordion-collapse collapse" aria-labelledby="sh8" data-bs-parent="#search_accordion">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/general-service-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 1<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_accordion_body">
                          <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/general-service-white.svg')}}" class="img-fluid" /></div>
                          <div class="stext">
                            Schedule a visit 2<br/>Status - <span class="text-orange">Pending</span><br/>
                            <span class="text-grey">Date : 16/03/2023</span>
                          </div>
                          <div class="saction">
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>


          </div> -->

          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>