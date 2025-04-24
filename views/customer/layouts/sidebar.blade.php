<div class="left-side-bar">
    <div class="brand-logo">
        <a href="#">
            <img src="{{ asset('logo3.png') }}" alt="">
        </a>
        @if(is_member())

            <p class="textWelcom"><i style="font-size: 18px;" class="dw dw-user-12"></i>   {{ get_member_username() }}
                <br>
                <strong style="font-size: 10px;font-weight: 100;" class="text-center text-white">Member</strong>
            </p>
        @else
            <p class="textWelcom"><i style="font-size: 18px;" class="dw dw-user-12"></i>  {{auth()->user()->accountName}}
                <br>
                <strong style="font-size: 10px;font-weight: 100;" class="text-center text-white">homeowner</strong>
            </p>
        @endif


    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('customer.dashboard') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/dashboard') ? 'active' : '' }}">
                        <span class="micon dw dw-menu"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.my_homes.index') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/my-homes') ? 'active' : '' }}">
                        <span class="micon dw dw-home"></span>
                        <span class="mtext">My Homes</span>
                    </a>
                </li>

            @if(!is_member())
                <li>
                    <a href="{{ route('customer.subscriptions') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/subscriptions') ? 'active' : '' }}">
                        <span class="micon dw dw-invoice"></span>
                        <span class="mtext">My Subscriptions</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('customer.device.list') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/device*') ? 'active' : '' }}">
                        <span class="micon dw dw-chip"></span>
                        <span class="mtext">My Smart Devices</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customer.consumption') }}"
                       class="dropdown-toggle no-arrow {{ request()->is('customer/consumption-log') ? 'active' : '' }}">
                        <span class="micon dw dw-analytics"></span>
                        <span class="mtext">Energy Consumption</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('customer.device.emergencies') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/emergencies') ? 'active' : '' }}">
                        <span class="micon dw dw-warning"></span>
                        <span class="mtext">Emergency Incidents</span>
                    </a>
                </li>

{{--                <li>--}}
{{--                    <a href="{{ route('customer.device.emergencyContacts') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/emergency-contacts') ? 'active' : '' }}">--}}
{{--                        <span class="micon dw dw-phone-call"></span>--}}
{{--                        <span class="mtext">Emergency Contacts</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                @if(!is_member())
                <li>
                    <a href="{{ route('customer.members.index') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/members*') ? 'active' : '' }}">
                        <i class="micon dw dw-group"></i> <span class="mtext">Family Members</span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('customer.support.index') }}" class="dropdown-toggle no-arrow {{ request()->is('customer/support*') ? 'active' : '' }}">
                        <span class="micon dw dw-chat3"></span>
                        <span class="mtext">Technical Support</span>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
