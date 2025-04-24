@extends('website.layouts.app')

@section('title', 'Welcome to EcoSecure Home')

@section('content')

    <section class="header_slider_area header_slider_style_2 owl-carousel">
        <div class="header_slider_bg">
            <div class="container">
                <div class="secure_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="228" preserveAspectRatio="xMidYMid" viewBox="0 0 126.938 121.844" width="241">
                        <path d="m63.466 9.901c18.908 0 24.18-10.257 25.458-9.673 22.223 10.152 38.007 32.156 38.007 58.153 0 35.05-28.414 63.465-63.465 63.465s-63.465-28.415-63.465-63.465c0-26.194 15.574-49.403 38.518-58.374 1.426-.558 6.354 9.894 24.947 9.894z" fill="#57b857" fill-rule="evenodd"></path>
                    </svg>
                    <p>Smart Living, Total Control</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="header_slide_box">
                            <h1>Effortless Home Automation</h1>
                            <p>Control your home devices remotely, schedule automation, and enhance convenience with our smart system.</p>
                            <a href="{{route('login')}}" class="btn btn-default default_btn">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: 24/7 Security & Alerts -->
        <div class="header_slider_bg bg_2">
            <div class="container">
                <div class="secure_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="228" preserveAspectRatio="xMidYMid" viewBox="0 0 126.938 121.844" width="241">
                        <path d="m63.466 9.901c18.908 0 24.18-10.257 25.458-9.673 22.223 10.152 38.007 32.156 38.007 58.153 0 35.05-28.414 63.465-63.465 63.465s-63.465-28.415-63.465-63.465c0-26.194 15.574-49.403 38.518-58.374 1.426-.558 6.354 9.894 24.947 9.894z" fill="#57b857" fill-rule="evenodd"></path>
                    </svg>
                    <p>Advanced Security, Peace of Mind</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="header_slide_box">
                            <h1>Stay Alert, Stay Secure</h1>
                            <p>Receive real-time alerts, monitor your home 24/7, and ensure your family’s safety with cutting-edge security features.</p>
                            <a href="#" class="btn btn-default default_btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Energy Efficiency -->
        <div class="header_slider_bg">
            <div class="container">
                <div class="secure_box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="228" preserveAspectRatio="xMidYMid" viewBox="0 0 126.938 121.844" width="241">
                        <path d="m63.466 9.901c18.908 0 24.18-10.257 25.458-9.673 22.223 10.152 38.007 32.156 38.007 58.153 0 35.05-28.414 63.465-63.465 63.465s-63.465-28.415-63.465-63.465c0-26.194 15.574-49.403 38.518-58.374 1.426-.558 6.354 9.894 24.947 9.894z" fill="#57b857" fill-rule="evenodd"></path>
                    </svg>
                    <p>Save Energy, Save Money</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="header_slide_box">
                            <h1>Efficient Energy Management</h1>
                            <p>Track and reduce your electricity and water consumption with smart insights, lowering costs while protecting the environment.</p>
                            <a href="#" class="btn btn-default default_btn">Start Saving</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Action Area -->
    <section id="features" class="feature_action_area section_padding section_bb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pl_0">
                    <div class="feature_action_left">
                        <div class="img_box"></div>
                        <div class="activity_title">
                            Don't miss a moment of <span>activity</span> at home
                        </div><!--end .activity_title-->
                    </div><!--end .feature_action_left-->
                </div><!--end .col-md-6-->
                <div class="col-md-6">
                    <div class="feature_action_right">
                        <div class="hero_section_title mb_50">
                            <h4>Connected home security systems</h4>
                            <h1>Interactive Features in Action</h1>
                        </div><!--end .hero_section_title-->
                        <ul>
                            <li><i class="icon-turn-off"></i> Instant control of home devices from anywhere</li>
                            <li><i class="icon-turn-off"></i> Arm / disarm your home security system</li>
                            <li><i class="icon-video-camera-2"></i> Live video monitoring</li>
                            <li><i class="icon-notification"></i> Advanced alert system to protect you from any risks</li>
                            <li><i class="icon-unlock"></i> Unlock the front door</li>
                            <li><i class="fa fa-file"></i> Smart reports to help you reduce energy consumption</li>
                            <li><i class="icon-idea"></i> Energy saving with smart operating modes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="automation_control_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero_section_title text-center mb_50 mb-5">
                        <h4>automation and control</h4>
                        <h1>Powering the Smart Home</h1>
                    </div><!--end .hero_section_title-->
                </div><!--end .col-md-12-->
            </div><!--end .row-->
            <div class="automation_control_section">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                        <div class="automation_control_box light_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box text-left">
                                <i class="icon-idea"></i>
                                <div class="automation_details">
                                    <h3>Light Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                    <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                        <div class="automation_control_box cooker_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box text-left">
                                <i class="icon-idea"></i>
                                <div class="automation_details">
                                    <h3>kitchen Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                    <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                        <div class="automation_control_box window_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box text-left">
                                <i class="icon-idea"></i>
                                <div class="automation_details">
                                    <h3>Window Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                    <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                        <div class="automation_control_box bathroom_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box text-left">
                                <i class="icon-idea"></i>
                                <div class="automation_details">
                                    <h3>Bathroom Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="automation_control_box cctv_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box">
                                <i class="icon-cctv"></i>
                                <div class="automation_details">
                                    <h3>CCTV Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                        <div class="automation_control_box wall_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box">
                                <i class="icon-cctv"></i>
                                <div class="automation_details">
                                    <h3>CCTV Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                    <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                        <div class="automation_control_box garage_control">
                            <i class="fa fa-plus plus_point"></i>
                            <div class="automation_details_box text-left">
                                <i class="icon-car"></i>
                                <div class="automation_details">
                                    <h3>Garage Controls</h3>
                                    <p>Manage lights with automatic schedules, and set rules to have lights automatically turn on.</p>
                                </div><!--end automation_details-->
                            </div><!--end .automation_details_box-->
                        </div><!--end .automation_control_box-->
                    </div><!--end .col-md-2-->
                </div><!--end .row-->
            </div><!--end .automation_control_section-->
        </div><!--end .container-->
        <img src="{{asset('website/assets/images/house.png')}}" alt="House" class="house">
    </section>
@endsection
