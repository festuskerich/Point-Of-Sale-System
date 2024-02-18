



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {margin:0;font-family:Arial}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
</head>
<body>
    


<div class="topnav" id="myTopnav">
     
    
 <a class="navbar-brand" href="/">{{config('app.name', 'ultimatePOS')}}</a>
  <a class="navbar-brand" href="https://play.google.com/store/apps/details?id=kaytonpos.aplicywr">  <img src="../img/app.png"width="120" height="30" class="img-fluid" alt=""></a>
 

 @if (Route::has('login'))
            @if(!Auth::check())
                <a href="{{ route('login') }}">@lang('lang_v1.login')</a>
                @if(config('constants.allow_registration'))
                    <a href="{{ route('business.getRegister') }}">@lang('lang_v1.register')</a>
                @endif
            @endif
        @endif
      @if(Auth::check())
            <a href="{{ action('HomeController@index') }}">@lang('home.home')</a>
        @endif
        @if(Route::has('frontend-pages') && config('app.env') != 'demo' 
        && !empty($frontend_pages))
            @foreach($frontend_pages as $page)
                <a href="{{ action('\Modules\Superadmin\Http\Controllers\PageController@showPage', $page->slug) }}">{{$page->title}}</a>
            @endforeach
        @endif
        @if(Route::has('pricing') && config('app.env') != 'demo')
        <a href="{{ action('\Modules\Superadmin\Http\Controllers\PricingController@index') }}">@lang('superadmin::lang.pricing')</a>
        @endif
        @if(Route::has('repair-status'))
        
          <a href="{{ route('business.getRegister') }}">
            @lang('repair::lang.repair_status')
          </a>
          <a href="#faqs">FAQs</a>
        
        
        
        @endif
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>



<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>
