<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here">
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">

        @php
            $notifications = \App\Http\Controllers\Customer\CustomerController::getEmergencyNotifications();
        @endphp

        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active">{{$notifications['count']}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            @forelse($notifications['notifications'] as $notification)
                                <li>
                                    <a href="#">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ asset('def.webp') }}" width="40" class="rounded-circle mr-2" alt="alert">
                                            <div>
                                                <h6 class="mb-1">
                                                    {{ ucfirst($notification['status']) }} Emergency
                                                </h6>
                                                <small class="text-muted d-block" style="font-size: 12px">{{ $notification['time'] }}</small>

                                                <p class="mb-0 text-dark">{{ $notification['message'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a href="#"><p class="text-muted text-center">No alerts available</p></a>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="text-center border-top p-2">
                        <a href="{{ route('customer.notifications') }}" class="text-primary">View All Alerts</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-info-dropdown">
            <div class="dropdown">
                <a style="    margin-right: 29px;" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<i class="fa fa-user-circle"></i>
						</span>
                    <span class="user-name">
                        @if(is_member())
                          {{ get_member_username() }}
                        @else
                            {{auth()->user()->accountName}}
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    @if(!is_member())
                    <a class="dropdown-item" href="{{route('customer.profile.edit')}}"><i class="dw dw-user1"></i> Profile</a>
                    @endif
                    <a class="dropdown-item logout-btn" href="#"><i class="dw dw-logout"></i> Log Out</a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
