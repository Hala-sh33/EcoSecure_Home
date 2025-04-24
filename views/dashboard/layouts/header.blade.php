<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
{{--            <form>--}}
{{--                <div class="form-group mb-0">--}}
{{--                    <i class="dw dw-search2 search-icon"></i>--}}
{{--                    <input type="text" class="form-control search-input" placeholder="Search Here">--}}
{{--                    <div class="dropdown">--}}
{{--                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">--}}
{{--                            <i class="ion-arrow-down-c"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
{{--                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">--}}
{{--                    <i class="dw dw-settings2"></i>--}}
{{--                </a>--}}
            </div>
        </div>
        @php
            use App\Models\Message;
            $unreadMessages = Message::whereNull('reply')->take(5)->with('sender')->get();
            $unreadCount = $unreadMessages->count();
        @endphp

        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    @if($unreadCount > 0)
                        <span class="badge notification-active">{{ $unreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            @forelse($unreadMessages as $message)
                                <li>
                                    <a href="{{ route('admin.support.index') }}">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ asset('def.webp') }}" width="40" class="rounded-circle mr-2" alt="alert">
                                            <div>
                                                <h6 class="mb-1">{{ $message->sender->accountName ?? 'Unknown' }}</h6>
                                                <p class="mb-0 text-dark">{{ Str::limit($message->text, 40) }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><p class="text-muted text-center">No new messages</p></a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="text-center border-top p-2">
                        <a href="{{ route('admin.support.index') }}" class="text-primary">View All</a>
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
                    <span class="user-name">{{auth()->user()->accountName}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item logout-btn" href="#"><i class="dw dw-logout"></i> Log Out</a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
