<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card border-0 rounded-3">
        <a class="btn btn-sm p-2 btn-primary mb-3 dropdown-toggle d-lg-none d-block" data-bs-toggle="collapse" href="#serviceListLinks" role="button" aria-expanded="false" aria-controls="serviceListLinks">
            Manage Services
        </a>
        <div class="list-group w-100 serviceListLinks " id="serviceListLinks">
            <a href="{{ route('services-admin-cancel-schedule-visit-list') }}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-schedule-visit-list')) active @endif" aria-current="true">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Scheduled Visit
            </a>
            <a href="{{route('services-admin-cancel-hosted-event-list')}}" class="list-group-item list-group-item-action  @if(Request::is('services/admin/cancel-hosted-event-list')) active @endif">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Hosted Event
            </a>
            <a href="{{route('services-admin-cancel-allocate-resources-list')}}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-allocate-resources-list')) active @endif">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Allocated Computing Resources
            </a>
            <a href="{{route('services-admin-cancel-reserve-incubator-list')}}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-reserve-incubator-list')) active @endif ">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Reserved Incubator
            </a>
            <a href="{{route('services-admin-cancel-reserve-technology-list')}}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-reserve-technology-list')) active @endif">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Reserved Technology Workshop
            </a>
            <a href="{{route('services-admin-cancel-submit-idea-list')}}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-submit-idea-list')) active @endif">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel Submitted Idea
            </a>
            <a href="{{route('services-admin-cancel-general-reservation-list')}}" class="list-group-item list-group-item-action @if(Request::is('services/admin/cancel-general-reservation-list')) active @endif">
                <i class="serviceLine">
                    <span class="line"><span class="inner"></span></span>
                    </svg>
                </i>
                Cancel General Reservation
            </a>
        </div>
    </div>
</div>
