<!doctype html>
<?php 
$user = Auth::user();
$username = $user->username;
$userId = $user->id;
$path_to_users = "users";
$user_profile_img = 'users/'.$username.$userId.'/'.$username.'image001.jpg';
if(empty($titlePage)){
  $titlePage = 'Error';
}

?>
<html lang="en">
<head>
    <title>{{$titlePage}}</title>
    <link rel="stylesheet" href="{{asset('css/pure.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/marketing.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font.awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
    <script type="text/javascript" src="{{asset('js/countdown/jquery.plugin.js')}}"></script> 
    <script type="text/javascript" src="{{asset('js/countdown/jquery.countdown.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/1.4.1/css/ionicons.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('js/countdown/jquery.countdown.css')}}"> 
</head>
<body>
<div class="header">
    <div class="pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed home-menu">
        <a class="pure-menu-heading white-heading" href="{{url('feed')}}">Timestamp</a>

        <ul>
            <form method="POST" action="{{action('SearchController@handleSearch')}}">
            <li><input type="search" name="search" placeholder="Search"></li>
            <li><a href="#"><i class="ion-android-earth icon-size-noah"></i></a></li>
            <li><a href="{{action('FeedController@feed')}}"><i class="ion-social-buffer icon-size-noah"></i></a></li>
            <li><a href="#" data-toggle="modal" data-target="#post"><i class="ion-edit icon-size-noah"></i></a></li>
            <li><a href="{{url("profile/$user->id")}}"><img class="icon-size-noah" src="{{asset($user_profile_img)}}"/></a></li>
            <li><a href="{{action('UserController@settings')}}"><i class="ion-ios7-gear icon-size-noah"></i></a></li>
            <li><a href="{{action('AuthController@logout')}}"><i class="glyphicon glyphicon-log-out icon-size-noah"></i></a></li>
            </form>
        </ul>
    </div>
</div>

<div class="modal fade" id="post" tabindex="-1" role="dialog" aria-labelledby="postModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title post-create" id="postLabel"><i class="glyphicon glyphicon-pencil"></i>&nbsp;<span>Write Something</span></h4>
      </div>
      <form method="POST" action="{{action('PostController@check')}}" enctype="multipart/form-data">
      <div class="modal-body">
        <textarea name="content" required></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       
        <button type="submit" id="stamp" class="btn btn-primary">Post</button>
        <button type="button" style="float:left" id="clear_upload" class="btn btn-danger">Clear</button>

        <div class="fileUpload button-secondary pure-button">  
            <span id="upload_title">Upload</span>
            <input type="file" id="profile_image" name="post_img" class="upload" />
        </div>
        <input type="hidden" id="image_classes" name="classes">
        <span class="post-image"><input type="hidden" value="false" name="has_image"></span>
        <br>
        <br>
        <center id="previews">
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="washed demo">
          </div>
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="vibrant demo">
          </div>
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="gray demo">
          </div>
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="inverted demo">
          </div>
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="blur demo">
          </div>
          <div class="spacer-templates">
            <img src="" height="50" width="67" class="washed demo">
          </div>
        </center>
        <img id="preview_img" style="margin-top:20px;max-width:560px;height:auto" src="">
      </div>
      </form>
    </div>
  </div>
</div>

@yield('content')
<!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer">
    <div class="pure-menu pure-menu-horizontal pure-menu-open">
        <ul>
            <li><a href="http://purecss.io/">About</a></li>
            <li><a href="http://twitter.com/yuilibrary/">Twitter</a></li>
            <li><a href="http://github.com/yui/pure/">Github</a></li>
        </ul>
    </div>
</footer>
-->

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/autogrow.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
$('#previews').hide();
$('#clear_upload').hide();
$('#profile_image').on('change', function(){
  var filename = $(this).val();
  if (!filename.match(/\.(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/)){
      $('#upload_title').html('Upload');
      $('.post-image').html('<span style="color:red;float:left">Please upload an image.</span>' + '<input type="hidden" value="false" name="has_image">');
      $('#previews').hide();
      $('#clear_upload').hide();
  }
  else {
    $('#upload_title').html('Change');
    $('#previews').show();
    $('#clear_upload').show();
    var reader = new FileReader();
    reader.onload = function (e) {
        $('.demo').attr('src', e.target.result);
        $('#preview_img').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
    $('.post-image').html('<input type="hidden" value="true" name="has_image">');
  };
});
$('#clear_upload').click(function(){
  $('#upload_title').html('Upload');
  $('#profile_image').val('');
  $(this).hide();
  $('#previews').hide();
});
$('.spacer-templates').click(function(){
  if (typeof $(this).attr('checked') != 'undefined')
  {
    $('#image_classes').val($('#preview_img').attr('class'));
    $('#preview_img').removeClass($('img', this).attr('class').split(' ')[0]);
    $('#check', this).remove();
    $(this).removeAttr('checked');
  }
  else
  {
    
    $('#preview_img').addClass($('img', this).attr('class').split(' ')[0]);
    $('#image_classes').val($('#preview_img').attr('class'));
    $(this).attr('checked', 'true');
    var pos = $(this).position();
    $(this).append('<img id="check" width="20" height="20" src="{{asset('img/check.png')}}" style="z-index:1;position:absolute;left:' + (pos.left+2) + 'px;top:' + (pos.top+2) + 'px;outline:none;">')
  }
  
})
$(function() {
   $('#comment').css('overflow', 'hidden').autogrow()
});
</script>

@yield('js')

</body>
</html>
