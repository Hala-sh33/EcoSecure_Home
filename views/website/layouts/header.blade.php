<header class="header_area">
    <div class="main_menu_area menu_style_2 scroll_fixed">
        <div class="left_logo">
            <button type="button" class="navbar-toggles">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('home') }}" class="logo">
                <img style="height:80px;width: 80px;" src="{{ asset('logo3.png') }}" alt="Logo"> <strong class="loggotext">EcoSecure Home</strong>
            </a>
        </div><!--end .left_logo-->

        <div class="middle_menu collapse_responsive text-right">
            <span class="close_menu_area_btn">x</span>
            <div class="collapse navbar-collapse remove_padding" id="myNavbar">
                <ul class="nav navbar-nav text-center">
                    <li>
                        <a class="{{ request()->routeIs('home') ? 'active2' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a href="#" onclick="redirectToFeatures()">Features</a>
                    </li>
                    <li >
                        <a class="{{ request()->routeIs('about') ? 'active2' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li >
                        <a class="{{ request()->routeIs('services') ? 'active2' : '' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li >
                        <a class="{{ request()->routeIs('pricing') ? 'active2' : '' }}" href="{{ route('pricing') }}">Pricing</a>
                    </li>
                    <li >
                        <a class="{{ request()->routeIs('contact') ? 'active2' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

            </div><!--end .collapse-->
        </div><!--end .middle_menu-->

        <div class="right_contact">
         <a style="display: flex;" class="d-flex" href="{{route('login')}}">
             <i class="icon-play-button"></i>
             <p> <span>LOG IN</span></p>
         </a>
        </div><!--end .right_contact-->
    </div><!--end .main_menu_area-->
</header><!--end .header_area-->

