


@section('content')
    <div class="login-form col-md-12 col-xs-12 right-col-content" >
        <p class="form-header text-white">@lang('lang_v1.login')</p>
        <form method="POST" action="{{ route('login') }}" id="">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                @php
                    $username = old('username');
                    $password = null;
                    if(config('app.env') == 'demo'){
                        $username = 'admin';
                        $password = '123456';

                        $demo_types = array(
                            'all_in_one' => 'admin',
                            'super_market' => 'admin',
                            'pharmacy' => 'admin-pharmacy',
                            'electronics' => 'admin-electronics',
                            'services' => 'admin-services',
                            'restaurant' => 'admin-restaurant',
                            'superadmin' => 'superadmin',
                            'woocommerce' => 'woocommerce_user',
                            'essentials' => 'admin-essentials',
                            'manufacturing' => 'manufacturer-demo',
                        );

                        if( !empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types) ){
                            $username = $demo_types[$_GET['demo_type']];
                        }
                    }
                @endphp
                <input id="username" type="text" class="form-control" name="username" value="{{ $username }}" required autofocus placeholder="@lang('lang_v1.username')">
                <span class="fa fa-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password"
                value="{{ $password }}" required placeholder="@lang('lang_v1.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('lang_v1.remember_me')
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat btn-login">@lang('lang_v1.login')</button>
                @if(config('app.env') != 'demo')
                <a href="{{ route('password.request') }}" class="pull-right">
                    @lang('lang_v1.forgot_your_password')
                </a>
            @endif
            </div>
        </form>
    </div>
  
@stop





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<title> Free Stylish Login Page Website Template | Smarteyeapps.com</title>-->

    <link rel="shortcut icon" href="{{asset('assets/images/fav.jpg')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawsom-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
</head>

<body>
    <div class="container-fluid ">
        <div class="container ">
            <div class="row cdvfdfd">
                <div class="col-lg-10 col-md-12 login-box">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 log-det">
                            <div class="small-logo">
                                <i ></i> KaytonPOS
                            </div>
                            <p class="dfmn"All in One ERP, POS,E-Commerce, Inventory and Invoicing Software for SMEs and Small Businesses.</p>
                            
<form method="POST" action="{{ route('login') }}" id="">
            {{ csrf_field() }}

                            <div class="text-box-cont">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                     <input id="username" type="text" class="form-control" name="username" value="{{ $username }}" required autofocus placeholder="@lang('lang_v1.username')">
                                     
                                </div>
                                
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password"
                value="{{ $password }}" required placeholder="@lang('lang_v1.password')">
                                </div>
                            
                                <div class="input-group center">
                                    <button type="submit" class="btn btn-primary btn-flat btn-login">@lang('lang_v1.login')</button>
                                     <a href="{{ route('password.request') }}>
                                     
                                    <button type="button"  class="btn btn-danger btn-flat btn-login">Forgot your Password</button>
                                    </a>
                                     <div class="row">
                                    <p style="position:center;" class="forget-p">Don't have an account? <span><a href="https://premierpos.kaytontech.com/business/register">Sign Up Now</a></span></p>
                                </div>
                                    
                                    
                                </div> 
                                <div class="row">
                                   
                                    </form>
                                </div>
                                 <div class="row">
                                    <p class="small-info">Connect With Social Media</p>
                                </div>   
                            </div>
                            
                            
                            
                            <div class="row">
                                <ul>
                                    
                                     <a href="https://www.facebook.com/KaytonTech/" ><li><i class="fab fa-facebook-f"></i></li></a>
                                     
                                     
                                     
                                      <a href="https://www.linkedin.com/in/kayton-technologies-50a142205/?originalSubdomain=ke"><li><i class="fab fa-linkedin-in"></i></li></a>
                                       <a href="https://twitter.com/abedi_muange?lang=fi"><li><i class="fab fa-twitter"></i></li></a>
                                    
                                    
                                    
                                </ul>
                            </div>
                           


                        </div>
                        <div class="col-lg-6 col-md-6 box-de">
                           <div class="inn-cover">
                               <div class="ditk-inf">
                                   <div class="small-logo">
                              
                                  
                                      
                                      
                                      
                                     
                                      <a href="https://premierpos.kaytontech.com/pricing">
                                     
                                    <button type="button"  class="btn btn-success btn-flat btn-login">Pricing Plans</button>
                                    </a>
                                      
                                      
                                      
                                   
                                </div>
                                 <div class="foter-credit">
                                  <a href="https://kaytontech.com/">Designed by :KaytonTech</a>  
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>



<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js"')}}"></script>

<script src="{{asset('assets/js/popper.min.js')}}"></script>

</html>

