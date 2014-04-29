
<!doctype html>
<html lang="en">
<head>
    <title>Timestamp</title>
    
    <link rel="stylesheet" href="{{asset('css/pure.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body>


<div class="header">
    <div class="pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed home-menu">
        <a class="pure-menu-heading timestamp-registration">Timestamp</a>
        <ul>
        <form method="POST" action="{{action('AuthController@handleLogin')}}">
            <li><input class="form-control input-sm email" type="text" placeholder="Username or email" name="email"></li>
            <li><input class="form-control input-sm" type="password" placeholder="Password" name="password"></li>
            <li><input class="btn btn-link regis-btn" type="submit" value="Sign In"></li>
        </form>
        </ul>
    </div>
</div>

<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">
            Timestamp
        </h1>
        <p class="splash-subhead">
           @if(isset($error))
                {{$error}}
            @else
                Let the world know what you're thinking 
            @endif
        </p>
        <p>
            <br>
            <a href="#" class="pure-button pure-button-primary sign-up">Sign Up</a>
            <br><br>
            <!-- <a href="#" class="pure-button pure-button-primary btnlog">Login</a>-->
            <br><br><br><br>
            <center><a href="#"><img class="btnapp" src="{{asset('graphics/ios.png')}}"></a><span></span>
            <a href="#"><img class="btnapp" src="{{asset('graphics/android.png')}}"></a><span></span>
            <a href="#"><img class="btnapp" src="{{asset('graphics/windows.png')}}"></a><span></span></center>
        </p>
    </div>
</div>

<div class="overlay">
    <div class="signup-box">
        <h3>Sign Up</h3>
        <form class="pure-form">
            <fieldset class="pure-group">
                <span style="color:red" id="register_error"></span>
                <input class="full" type="text" id="name" name="username" placeholder="Username">
                <input class="full" type="email" name="email" id="email" placeholder="Email">
                <input class="full" type="password" name="password" id="password" placeholder="Password">
                <input type="button" value="Go" onClick="javascript:handleRegister()" class="pure-button pure-button-primary full">
            </fieldset>
        </form>
    </div>
</div>

<div class="overlay-login">
    <div class="signup-box">
        <h3>Login</h3>
        <form class="pure-form" method="POST" action="{{action('AuthController@handleLogin')}}">
            <fieldset class="pure-group">
                <input class="full" type="text" id="name" name="email" placeholder="Username">
                <input class="full" type="password" name="password" id="password" placeholder="Password">
                <input type="button" value="Go" onClick="javascript:handleRegister()" class="pure-button pure-button-primary full">
            </fieldset>
        </form>
    </div>    
</div>

<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui-min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});
</script>
<script type="text/javascript">
    $overlay = $('.overlay');
    $overlayLog = $('.overlay-login');
    $signup = $('.sign-up');
    $signupbox = $('.signup-box');
    $login = $('.btnlog');
    $email = $('.email');
    $loginbtn = $('.btnlog');
    $login.click(function() {
    $email.focus();
    });
    $signup.click(function(){
        $overlay.fadeIn();
    });
    $loginbtn.click(function(){
        $overlayLog.fadeIn();
    });
    $overlayLog.click(function(){
        if (!$signupbox.is(':hover')) {
            $overlayLog.fadeOut();
        };
    });
    $overlay.click(function(){
        if (!$signupbox.is(':hover')) {
            $overlay.fadeOut();
        };
        
    });

function handleRegister()
{
    $.ajax({
        method: 'POST',
        url: '{{action("AuthController@handleRegister")}}',
        data: {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val()
        }
    }).done(function(data){  
        data_arr = data.split(':');
        if (data_arr[0] == 'error') {
            $('#register_error').html(data_arr[1]);
        }
        else {
            window.location = '/';
        }
    })
}


</script>

</body>
</html>
