<html>
<head>
 <link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/bootstrap4/bootstrap.min.css') }}">
 <!-- js placed at the end of the document so the jqery can be written -->
 <script src="{{ asset('one_tech/js/jquery-3.3.1.min.js') }}"></script>
 <link src="{{ asset('css/app.css') }}">
 <script src="{{ asset('one_tech/styles/bootstrap4/popper.js') }}"></script>
 <script src="{{ asset('one_tech/styles/bootstrap4/bootstrap.min.js') }}"></script>
 <link href="{{ asset('one_tech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
 @include('layouts/favicon')
 <title>{{config('app.name')}} : Customer Register</title>
 <!------ Include the above in your HEAD tag ---------->
</head>
<body>
<!--
    Realised by Thibault Leveau
    https://www.linkedin.com/in/thibault-leveau-a76923ba/
-->
<div>    
    <nav class="navbar navbar-expand-md navbar-light " style="background-color: white; ">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<h1 class="h1 text-info" align="center">Customer Registration</h1>
<div class="container" style="margin-top: 1em;">
    <!-- Sign up form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf 
        @method('post')
        <input type="hidden" value="customer" name="user_type" id="user_type">
        <!-- Sign up card -->
        <div class="card person-card">
            <div class="card-body">
                <!-- Sex image -->
                <img id="img_sex" class="person-img"
                src="{{ asset('img/system/male.svg') }}">

                <h2 id="who_message" class="card-title">Who are you ?</h2>
                <!-- First row (on medium screen) -->
                <div class="row">
                    <div class="form-group col-md-2">
                        @php
                        $old_gender = false;
                        if(old('gender',null)!=null){
                            $old_gender = true;
                        } 
                        @endphp
                        <select id="gender" name="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" value="{{ $old_gender ? old('gender') : 'Male' }}">
                            <option value="Male">Mr.</option>
                            <option value="Female">Ms.</option>
                        </select>
                        @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="form-group col-md-5">
                        <input id="first_name" name="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="First name" maxlength="100" value="{{ old('first_name') }}">
                        @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-5">
                        <input id="last_name" name="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Last name" maxlength="100" value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6" style="padding=0.5em;">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">How to contact you ?</h2>
                        <div class="form-group">
                            <label for="email" class="col-form-label ">Email</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="example@gmail.com" required maxlength="100" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tel" class="col-form-label ">Phone number</label>
                            <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone" maxlength="30" placeholder="+977 1234567890" required value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="country" class="col-form-label">Country</label>
                                <select name="country" id="country" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" value="{{ old('country') }}">
                                    @include('reuseable_codes/select_country_options')
                                </select>
                                @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                @endif
                                <script>
                                    jQuery(document).ready(function($) {
                                        $country = "{{ old('country',null) }}";
                                        if($country!=null){
                                            $('#country').val($country);
                                        }
                                    });
                                </script>

                            </div>
                            <div class="form-group col-md-5">
                                <label for="city" class="col-form-label">City / Village</label>
                                <input type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" id="city" name="city" placeholder="Yout city/village"  maxlength="300" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Address</label>
                            <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" name="address" placeholder="Your address"  maxlength="300" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif                               
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card"> 
                    <div class="card-body">
                        <h2 class="card-title">Your account !</h2>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control  {{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" placeholder="Type your Username" required value="{{ old('username') }}">
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Pasword (minimun 6 characters)</label>
                            <input type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Type your password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_conf" class="col-form-label">Pasword (confirm)</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Type your password again" required>
                            <div class="password_conf-feedback">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 1em;">
            <input type="submit" style="cursor: pointer;" class="btn btn-primary btn-lg btn-block" value="Register">
        </div>
    </form>
</div>
{{-- Assets for the page --}}
<style>
body {
    background-color: #e9ebee;
}

.card {
    margin-top: 1em;
}

/* IMG displaying */
.person-card {
    margin-top: 5em;
    padding-top: 5em;
}
.person-card .card-title{
    text-align: center;
}
.person-card .person-img{
    width: 10em;
    position: absolute;
    top: -5em;
    left: 50%;
    margin-left: -5em;
    border-radius: 100%;
    overflow: hidden;
    background-color: white;
}
</style>
<script>
    // URLs images
    var female_img = "{{ asset('img/system/female.png') }}";
    var male_img = "{{ asset('img/system/male.svg') }}";

// On page loaded
$( document ).ready(function() {
    // Set the sex image
    set_sex_img();
    
    // Set the "who" message
    set_who_message();

    // On change sex input
    $("#input_sex").change(function() {
        // Set the sex image
        set_sex_img();
        set_who_message();
    });

    // On change fist name input
    $("#first_name").keyup(function() {
        // Set the "who" message
        set_who_message();
        
        if(validation_name($("#first_name").val()).code == 0) {
            $("#first_name").attr("class", "form-control is-invalid");
            $("#first_name_feedback").html(validation_name($("#first_name").val()).message);
        } else {
            $("#first_name").attr("class", "form-control");
        }
    });

    // On change last name input
    $("#last_name").keyup(function() {
        // Set the "who" message
        set_who_message();
        
        if(validation_name($("#last_name").val()).code == 0) {
            $("#last_name").attr("class", "form-control is-invalid");
            $("#last_name_feedback").html(validation_name($("#last_name").val()).message);
        } else {
            $("#last_name").attr("class", "form-control");
        }
    });
});

/**
*   Set image path (Mr. or Ms.)
*/
function set_sex_img() {
    var sex = $("#input_sex").val();
    if ("Male".localeCompare(sex)) {
        // male
        $("#img_sex").attr("src", male_img);
    } else {
        // female
        $("#img_sex").attr("src", female_img);
    }
}

/**
*   Set "who" message
*/
function set_who_message() {
    var sex = $("#input_sex").val();
    var sal = " ";

    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    
    if (validation_name(first_name).code == 0 || 
        validation_name(last_name).code == 0) {
        // Informations not completed
    if("Male".localeCompare(sex)){
        sal = "Mr."
    }
    else if("Female".localeCompare(sex)){
        sal = "Ms."
    }
    $("#who_message").html("Who are you ?");
} else {
        // Informations completed
        if(sal!='undefined'&&sal!=""&&sal!=null){
            $("#who_message").html(sal+" "+first_name+" "+last_name);
        }
        else{
            $("#who_message").html(first_name+" "+last_name);   
        }
    }
}

/**
*   Validation function for last name and first name
*/
function validation_name (val) {
    if (val.length < 1) {
        // is not valid : name length
        return {"code":0, "message":"The name is too short."};
    }
    if (!val.match("^[a-zA-Z\- ]+$")) {
        // is not valid : bad character
        return {"code":0, "message":"The name use non-alphabetics chars."};
    }
    
    // is valid
    return {"code": 1};
}
</script>
</body>
</html>