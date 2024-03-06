<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
      <div class="card border-0 rounded-3">
        <a class="btn btn-sm p-2 btn-primary mb-3 dropdown-toggle d-lg-none d-block" data-bs-toggle="collapse" href="#serviceListLinks" role="button" aria-expanded="false" aria-controls="serviceListLinks">
         Common Available Services
        </a>
        <div class="list-group w-100 serviceListLinks " id="serviceListLinks">
          <a href="#" link-type="sc_visit"  data-href="{{route('services-schedule-visit')}}" class="list-group-item list-group-item-action userAccess @if(Request::is('services/schedule-visit')) active @endif" aria-current="true">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Schedule a Visit
          </a>
          <a href="#" link-type="host_event" data-href="{{route('services-host-event')}}" class="list-group-item userAccess list-group-item-action @if(Request::is('services/host-event')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Host an Event
          </a>
          <a href="#" data-href="{{route('services-allocate-resource')}}" link-type="allocate_visit" class="userAccess list-group-item list-group-item-action @if(Request::is('services/allocate-resource')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Allocate Computing Resources
          </a>
          <a href="#" link-type="incubator" data-href="{{route('services-reserve-incubator')}}" class=" userAccess list-group-item list-group-item-action @if(Request::is('services/reserve-incubator')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Reserve Incubator
          </a>
          <a  href="#" link-type="technology" data-href="{{route('services-reserve-technology')}}" class="userAccess list-group-item list-group-item-action @if(Request::is('services/reserve-technology')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Reserve Technology Workshop
          </a>
          <a href="#" link-type="idea" data-href="{{route('services-submit-idea')}}" class="userAccess list-group-item list-group-item-action @if(Request::is('services/submit-idea')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            Submit an Idea
          </a>
          <a href="#" link-type="general" data-href="{{route('services-general-reservation')}}" class="userAccess list-group-item list-group-item-action @if(Request::is('services/general-reservation')) active @endif">
            <i class="serviceLine">
              <span class="line"><span class="inner"></span></span>
              </svg>
            </i>
            General Reservation
          </a>
        </div>
      </div>
    </div>
