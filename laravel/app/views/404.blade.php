@extends('template')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <title>Error</title>
    
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body style="background-color:#0c83de;">


<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">We're sorry</h1>
        <p class="splash-subhead">
           The page you are looking for is not found
        </p>
        <p>
            <a href="{{action('FeedController@feed')}}" class="pure-button pure-button-primary sign-up">Feed</a>
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
