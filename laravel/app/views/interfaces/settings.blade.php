@extends('template')
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div>
            <section class="post">
                <table class="post-header-table">
                    <tr>
                        <td> 



                            <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="70" width="70" src="{{asset($user_profile_img)}}">

                        </td>
                        <td>
                            <header class="post-header">
                            <style scoped>
                                .button-success,
                                .button-error,
                                .button-warning,
                                .button-secondary {
                                    color: white;
                                    border-radius: 4px;
                                    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
                                }

                                .button-success {
                                    background: rgb(28, 184, 65); /* this is a green */
                                    float: right;
                                }
                                .button-success-settings{
                                    float: left !important;
                                }

                                .button-error {
                                    background: rgb(202, 60, 60); /* this is a maroon */
                                }

                                .button-warning {
                                    background: rgb(223, 117, 20); /* this is an orange */
                                }

                                .button-secondary {
                                    background: rgb(66, 184, 221); /* this is a light blue */
                                }

                            </style>  
                            
                                    <h4>{{$user->username}}</h4>

                                <p class="post-meta">
                                    <a href="#" class="post-author">{{$user->username}}</a> has been a user for <span class="time">  <span class="glyphicon glyphicon-time"></span></span>
                                </p>
                            </header>
                        </td>
                        <td>
                            <form action="{{action('UserController@handleUpload')}}" method="POST" enctype="multipart/form-data" onchange="this.form.submit()">
                                
                                <div class="spacer-upload-button">
                                    <div class="fileUpload button-secondary pure-button">  
                                        <span>Upload</span>
                                        <input type="file" id="profile_image" name="profile" class="upload" />
                                    </div>
                                    <br><br>
                                    <span id="image_error" class="error"></span>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
                
            </section>
            <h1 class="post-tabs"><a class="reminder-link" href="javascript:sort('reminder-sort')">Reminder</a> <a class="posts-link" href="javascript:sort('posts-sort')">Posts</a></h1>
            <div class="profile-posts reminder-sort">
            <div class="post-spacer-profile">
                <section class="post post-container-border">
                        <table class="post-header-table">
                            <tr>
                                <td>
                                    <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="{{asset('timestampprof.png')}}">
                                </td>
                                <td>
                                    <header class="post-header">
                                        <p class="post-meta">
                                        <a class="post-author">timestamp</a> <br><span class="time">Heads up!</span>
                                        <br>
                                        <br>
                                        </p>
                                    </header>
                                </td>
                            </tr>
                        </table>
                        

                        <div class="post-description">
                            <p>
                                You are now editing your profile

                            </p>
                        </div>
                    </section>
                </div>
            <br>
            <br>
            <hr>
            @foreach($recent_posts as $post)
            <div class="post-spacer-profile posts-sort">
                <section class="post post-container-border">
                        <table class="post-header-table">
                            <tr>
                                <td>
                                    <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="{{asset('users/'.$post->user_info()->username.$post->user_info()->id.'/'.$post->user_info()->username.'image001.jpg')}}">
                                </td>
                                <td>
                                    <header class="post-header">
                                        
                                        <button type="submit" onClick="javascript:like( {{ $post->id }} )" class="arrow-button">
                                        @if ($user->hasLiked($post))
                                            <div class="arrow-up arrow-voted {{ $post->id }}"></div>
                                        @else
                                            <div class="arrow-up {{ $post->id }}"></div>
                                        @endif
                                        <br>
                                        <span class="post-likes">{{$post->countLikes()}}</span>
                                        </button>
                                        
                                        <p class="post-meta">
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{$post->username()}}</a> <br><span class="time">2d 5h <span class="glyphicon glyphicon-time"></span></span>
                                        </p>
                                    </header>
                                </td>
                            </tr>
                        </table>
                        

                        <div class="post-description">
                            <p>
                                {{{$post->content}}}
                                @if(file_exists('post_img'))
                                    @if($post->image_id == 1)
                                        <?php 
                                        list($width, $height) = getimagesize('post_img/'.$post->id.'/'.$post->id.'image001.jpg');?>
                                        <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
                                            <hr>
                                            <center><img style="width:70%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @endif

                            </p>
                        </div>
                    </section>
                </div>
            @endforeach
            </div>
            <div class="profile-about">
                <div class="post-spacer-profile">
                    
                    <section class="post post-about-card post-container-border">
                            <table>
                                <tr>
                                    <td>
                                        <a href="{{url('profile/'.$user->id.'/followers')}}" class="tab-links-info"><div class="post-header">
                                            Followers
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$user->followers()->count()}}
                                            </p>
                                        </div></a>
                                    </td>
                                    <td>
                                        <a href="{{url('profile/'.$user->id.'/following')}}" class="tab-links-info"><div class="post-header">
                                            Following
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$user->following()->count()}}
                                            </p>
                                        </div></a>
                                    </td>
                                    <td>
                                        <a href="#stamps" class="tab-links-info"><div class="post-header">
                                            Stamps
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$user->stampsCount()}}
                                            </p>
                                        </div></a>
                                    </td>
                                </tr>
                            </table>
                            
                        </section>
                </div>
            </div>
            <div class="profile-about">
                <div class="post-spacer-profile">
                    
                    <section class="post post-about-card post-container-border">
                        <div class="post-header">
                            About
                        </div>
                        <form action="{{action('UserController@handleAbout')}}" method="POST">
                            <div class="post-description">
                                <textarea class="about-textarea" name="about">{{$user->about}}</textarea>
                            </div>
                            <br>
                            <input type="submit" class="button-success pure-button button-success-settings">
                            <br>
                            <br>
                            
                        </form>
                        
                    </section>
                    <br>
                    <section class="post post-about-card post-container-border">
                        <div class="post-header">
                            Tell us about yourself!
                        </div>
                        <form action="{{action('UserController@handleDetails')}}" method="POST">
                            <div class="post-description">
                                <input type="text" class="details-input" name="firstname" value="<?php if(empty($user->firstname)){echo "First Name";}else{echo "$user->firstname";}?>">
                                <input type="text"  class="details-input" name="lastname" value="<?php if(empty($user->firstname)){echo "Last Name";}else{echo "$user->lastname";}?>">

                            </div>
                            <br>
                            <input type="submit" class="button-success pure-button button-success-settings">
                            <br>
                            <br>
                            
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')

<script type="text/javascript">
function sort(way){
    if (way == 'reminder-sort') {
        var left = '', right = '';
        $('.post-spacer-left.recent').each(function(){
            left = left + '<div class="post-spacer">' + $(this).html() + '</div>';
        });
        $('.post-spacer-right.recent').each(function(){
            right = right + '<div class="post-spacer">' + $(this).html() + '</div>';
        });
        $('.recent-posts-left').html(left);
        $('.recent-posts-right').html(right);
        $('.post-spacer-left.recent').hide();
        $('.post-spacer-right.recent').hide();
        $('.posts-sort').hide();
        $('.reminder-sort').show();
        $('.reminder-link').css('text-decoration', 'underline');
        $('.posts-link').css('text-decoration', 'none');
    }
    else {
        var left = '', right = '';
        $('.post-spacer-left.top').each(function(){
            left = left + '<div class="post-spacer">' + $(this).html() + '</div>';
        });
        $('.post-spacer-right.top').each(function(){
            right = right + '<div class="post-spacer">' + $(this).html() + '</div>';
        });
        $('.recent-posts-left').html(left);
        $('.recent-posts-right').html(right);
        $('.post-spacer-left.top').hide();
        $('.post-spacer-right.top').hide();
        $('.reminder-sort').hide();
        $('.posts-sort').show();
        $('.reminder-link').css('text-decoration', 'none');
        $('.posts-link').css('text-decoration', 'underline');
    }
}
$(document).ready(function(){
    sort('reminder-sort');
});
function like(post_id){
    $.ajax({
        type: 'POST',
        data: {
            'post_id': post_id
        },
        url: '{{ url('like')}}'
    }).done(function(data){
        $('.' + post_id).attr('class', data + ' ' + post_id);
    });
}

$('#profile_image').on('change', function(){
    var filename = $(this).val();
    if (!filename.match(/\.(jpg|jpeg|png|gif)$/)){
        $('#image_error').html('Please upload an image.');
    }
    else {
        $('#image_error').html('<input type="submit" class="button-success pure-button">');
    }
});


</script>

@stop


