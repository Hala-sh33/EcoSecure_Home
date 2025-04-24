<div class="left-side-bar">
    <div class="brand-logo">
        <a href="#">
            <img src="{{ asset('logo3.png') }}" alt="">

        </a>
        <p class="textWelcom"> Welcome : {{auth()->user()->accountName}}</p>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/dashboard') ? 'active' : '' }}" >
                        <i class="micon dw dw-bar-chart1"></i>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.admins.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/admins*') ? 'active' : '' }}">
                        <i class="micon dw dw-headphones1"></i>
                        <span class="mtext">Customer Services</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.customers.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/customers*') ? 'active' : '' }}" >
                        <span class="micon dw dw-user"></span>
                        <span class="mtext">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subscriptions.all') }}"
                       class="dropdown-toggle no-arrow {{ request()->is('admin/subscriptions*') ? 'active' : '' }}">
                        <span class="micon dw dw-list"></span>
                        <span class="mtext">Manage Subscriptions</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.homes.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/homes*') ? 'active' : '' }}">
                        <span class="micon dw dw-home"></span>
                        <span class="mtext">Homes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.smart-devices.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/smart-devices*') ? 'active' : '' }}">
                        <span class="micon dw dw-chip"></span>
                        <span class="mtext">Smart Devices</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.devices.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/devices*') ? 'active' : '' }}">
                        <i class="micon dw dw-shop"></i>
                        <span class="mtext">Inventory Devices</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.device-details.index') }}" class="dropdown-toggle no-arrow {{ request()->is('admin/device-details*') ? 'active' : '' }}">
                        <span class="micon dw dw-monitor"></span>
                        <span class="mtext">Manage Devices</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.support.index') }}"
                       class="dropdown-toggle no-arrow {{ request()->is('admin/support*') ? 'active' : '' }}">
                        <span class="micon dw dw-message"></span>
                        <span class="mtext">Support Messages</span>
                    </a>
                </li>


                {{--                <li class="dropdown">--}}
{{--                    <a href="javascript:;" class="dropdown-toggle">--}}
{{--                        <span class="micon dw dw-user"></span><span class="mtext">Users</span>--}}
{{--                    </a>--}}
{{--                    <ul class="submenu">--}}
{{--                        <li><a href="{{ route('login') }}">All Users</a></li>--}}
{{--                        <li><a href="{{ route('login') }}">Add User</a></li>--}}
{{--                        <li><a href="{{ route('login') }}">Edit User</a></li>--}}
{{--                        <li><a href="{{ route('login') }}">Delete User</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <!-- System Logs -->--}}
{{--                <li><a href="#" class="dropdown-toggle no-arrow">--}}
{{--                        <span class="micon dw dw-notepad"></span><span class="mtext">System Logs</span></a></li>--}}

{{--                <li><a href="#" class="dropdown-toggle no-arrow">--}}
{{--                        <span class="micon dw dw-bell"></span><span class="mtext">Notifications</span></a></li>--}}
            </ul>
        </div>
    </div>
</div>
