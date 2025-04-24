@extends('auth.app')

@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Login To EcoSecure Home</h2>
        </div>
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="select-role">
                <div style="flex-direction: column;flex-wrap: nowrap;" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn active w-100 mb-3">
                        <input type="radio" name="accountType" onchange="changeType('admin')" value="admin" required>
                        <div class="icon"><img src="{{ asset('assets/vendors/images/briefcase.svg') }}" class="svg" alt=""></div>
                        <span>I'm</span> Manager/Staff
                    </label>
                    <label class="btn w-100 mb-3">
                        <input type="radio" name="accountType" onchange="changeType('homeowner')" value="homeowner" required>
                        <div class="icon"><img src="{{ asset('assets/vendors/images/person.svg') }}" class="svg" alt=""></div>
                        <span>I'm</span> Homeowner
                    </label>
                    <label class="btn w-100 mb-3">
                        <input type="radio" name="accountType" onchange="changeType('member')" value="member" required>
                        <div class="icon"><img src="{{ asset('assets/vendors/images/person.svg') }}" class="svg" alt=""></div>
                        <span>I'm</span> Member
                    </label>
                </div>
            </div>
            {{-- Member Username (Hidden by default) --}}
            <div class="input-group custom d-none" id="memberInputGroup">
                <input type="text" name="userName" class="form-control form-control-lg" placeholder="Username (Member)">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
           <div id="loginInputGroup">
               <div class="input-group custom">
                   <input type="text" name="login" class="form-control form-control-lg" placeholder="Email or Phone" >
                   <div class="input-group-append custom">
                       <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                   </div>
               </div>
               <div class="input-group custom">
                   <input type="password" name="password" class="form-control form-control-lg" placeholder="**********" >
                   <div class="input-group-append custom">
                       <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                   </div>
               </div>
               <div class="row pb-30">
                   <div class="col-6">
                       <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="customCheck1">
                           <label class="custom-control-label" for="customCheck1">Remember</label>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="forgot-password"><a href="{{route('forgot_password')}}">Forgot Password</a></div>
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function changeType(type) {
            document.getElementById('loginInputGroup').classList.toggle('d-none', type === 'member');
            document.getElementById('memberInputGroup').classList.toggle('d-block', type === 'member');
        }
    </script>

@endsection
