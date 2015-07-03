@extends('template')
@section('title')
{{$userProf->username}}
@stop
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div>
            <section @if($userProf->id == $user->id) {{"class='cover cover-user'"}} @else {{"class='cover'"}} @endif style="background-image:url('{{asset('users/'.$userProf->username.$userProf->id.'/'.$userProf->username.'banner001.jpg')}}')">
                @if($userProf->id == $user->id)
                <form action="{{action('UserController@handleBanner')}}" class="test-spacer-saver" method="POST" enctype="multipart/form-data">
                    <div class="spacer-upload-button">
                        <div class="fileUpload button-secondary pure-button">  
                            <span>Upload</span>
                            <input type="file" id="profile_image" name="banner" class="upload" required />
                        </div>
                        <span id="image_error" class="error"></span>
                    </div>
                    <div class="spacer-upload-button">
                        <div class="fileUpload  button-success pure-button">  
                            <span>Submit</span>
                            <input type="submit" id="profile_image" class="upload" />
                        </div>
                        <span id="image_error" class="error"></span>
                    </div>
                </form>
                @endif
            <div class="spacer-upload"></div>
            <section class="post transparent">
                <table class="post-header-table" id="stamps">
                    <tr>
                        <td> 


                            @if($user->id == $userProf->id)

                            <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset($user_profile_img)}}">

                            @else
                            
                            <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset('users/'.$userProf->username.$userProf->id.'/'.$userProf->username.'image001.jpg')}}">

                            @endif
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

                                .button-error {
                                    background: rgb(202, 60, 60); /* this is a maroon */
                                    float: right;
                                }

                                .button-warning {
                                    background: rgb(223, 117, 20); /* this is an orange */
                                }

                                .button-secondary {
                                    background: rgb(66, 184, 221); /* this is a light blue */
                                }

                            </style>  
                            
                                    <h4>{{{$userProf->username}}}</h4>

                                <p class="post-meta">
                                    <a href="#" class="post-author">{{{$userProf->username}}}</a>&nbsphas been a user <span class="time"> <?php 
                                    $created_stamp = $userProf->created_at;
                                    $created_time = strtotime($created_stamp);
                                    $current_stamp = time();
                                    if ($created_time == 0) {
                                        $since = "since The Beginning";
                                        echo "$since <span class=\"glyphicon glyphicon-star-empty\"></span>";
                                    }
                                    else{
                                        $local = '14400';

                                        $since_general = $current_stamp-$created_time;
                                        $since = $since_general-$local;
                                        
                                        $since_time = date('l F jS g:i A Y', $created_time);
                                        $since_statement = "from $since_time";
                                        echo "$since_statement <span class=\"glyphicon glyphicon-time\"></span>";
                                    }

                                    ?></span>
                                </p>
                            </header>
                        </td>
                        <td>
                        @if($user->id == $userProf->id)
                            <form action="{{action('UserController@handleUpload')}}" method="POST" enctype="multipart/form-data">
                                
                                <div class="spacer-upload-button">
                                    <div class="fileUpload button-secondary pure-button">  
                                        <span>Upload</span>
                                        <input type="file" id="profile_image" name="profile" class="upload" required />
                                    </div>
                                    <br><br>
                                    <span id="image_error" class="error"></span>
                                </div>
                                <div class="spacer-upload-button">
                                    <div class="fileUpload  button-success pure-button">  
                                        <span>Submit</span>
                                        <input type="submit" id="profile_image" class="upload" />
                                    </div>
                                    <br><br>
                                    <span id="image_error" class="error"></span>
                                </div>
                            </form>
                            
                            @else 

                                @if($user->follows($userProf))
                                    <a href="{{action('UserController@unfollowUser', array('user_id'=>$userProf->id))}}" class="button-error pure-button" style="text-decoration: none">Unfollow</a>
                                @else                                   
                                    <a href="{{action('UserController@followUser', array('user_id'=>$userProf->id))}}" class="button-success pure-button" style="text-decoration: none;">+Follow</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
                
            </section>
            </section>
            <h1 class="post-tabs"><a class="recent-link">Posts</a></h1>
            <div class="profile-posts">
            @if(is_null($test))
            <div class="post-spacer-profile" style="height:400px">
                <section class="post post-container-border" id="stamps">
                        <table class="post-header-table">
                            <tr>
                                <td>
                                    <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="{{asset('users/'.$userProf->username.$userProf->id.'/'.$userProf->username.'image001.jpg')}}">
                                </td>
                                <td>
                                    <header class="post-header">
                                        <p class="post-meta">
                                        <a class="post-author">{{$userProf->username}}</a> <br><span class="time">Heads up!</span>
                                        <br>
                                        <br>
                                        </p>
                                    </header>
                                </td>
                            </tr>
                        </table>
                        

                        <div class="post-description">
                            <p>
                                
                                I don't have any stamps yet... ):
                            </p>
                        </div>
                    </section>
                
            </div>
            @endif
            @foreach($recent_posts as $post)

            <div class="post-spacer-profile">
                <section class="post post-container-border" >
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
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br><span class="time">2d 5h <span class="glyphicon glyphicon-time"></span></span>
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
                                            <center><img style="width:80%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @else
                                    <span>Image not found on server</span>
                                @endif
                            </p>
                        </div>
                        @foreach($post->replies()->take(3)->get() as $reply)
                        <?php 
                        ?>
                        <hr>

                        <a href="{{url("profile/$reply->user_id")}}"><img class="post-avatar reply-avatar" alt="Tilo Mitra&#x27;s avatar" height="38" width="38" src="{{asset('users/'.$reply->user_info()->username.$reply->user_info()->id.'/'.$reply->user_info()->username.'image001.jpg')}}"></a> 
                        <a href="{{url("profile/$reply->user_id")}}" class="post-author">{{{$reply->user->username}}}</a><span class="reply-timestamp"> on {{date('l F jS g:i A', strtotime($reply->created_at))}}</span>
                        <br>
                        <a class="tab-post-links" href="{{url('post/'.$post->id.'#'.$reply->id)}}"><p>
                            {{{$reply->content}}}
                            @if($reply->image_id == 1)
                                <?php 
                                list($width, $height) = getimagesize('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg');?>
                                <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
                                <br>
                                    <center><img style="width:50%;height:auto" class="{{$post->image_class}}" src="{{asset('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg')}}"></center>
                            @endif
                        </p></a>
                        @endforeach

                    </section>

                </div>
            @endforeach
            </div>
            <div class="right-tabs">
                <div class="profile-about">
                    <div class="post-spacer-profile">
                        
                        <section class="post post-about-card post-container-border">
                            <table>
                                <tr>
                                    <td>
                                        <a href="{{url('profile/'.$userProf->id.'/followers')}}" class="tab-links-info"><div class="post-header">
                                            Followers
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$userProf->followers()->count()}}
                                            </p>
                                        </div></a>
                                    </td>
                                    <td>
                                        <a href="{{url('profile/'.$userProf->id.'/following')}}" class="tab-links-info"><div class="post-header">
                                            Following
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$userProf->following()->count()}}
                                            </p>
                                        </div></a>
                                    </td>
                                    <td>
                                        <a href="#stamps" class="tab-links-info"><div class="post-header">
                                            Stamps
                                        </div>
                                        <div class="post-description stats">
                                            <p>
                                                {{$userProf->stampsCount()}}
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
                            <div class="post-description">
                                {{{$userProf->about}}}
                            </div>
                            
                        </section>
                    </div>
                </div>
                <div class="profile-about">
                    <div class="post-spacer-profile">
                        
                        <section class="post post-about-card post-container-border">
                            <div class="post-header tab-profile">
                                Followers
                                <div class="follower-tab">
                                @foreach($follower as $detail_id)
                                    <?php $detail = User::orderBy('username', 'desc')->find($detail_id->follower_user_id);?>
                                    <a href="{{url('profile/'.$detail->id)}}"><img class="post-avatar" id="profile_picture" height="40" width="40" title="{{{$detail->username}}}" src="{{asset('users/'.$detail->username.$detail->id.'/'.$detail->username.'image001.jpg')}}"></a>
                                @endforeach
                                </div>
                                <br>
                                <br>
                            </div>
                            
                        </section>
                    </div>
                </div>
                <div class="profile-about">
                    <div class="post-spacer-profile">
                        
                        <section class="post post-about-card post-container-border">
                            <div class="post-header">
                                Following
                                <div class="follower-tab">
                                @foreach($following as $detail_id)
                                    <?php $detail = User::orderBy('username', 'desc')->find($detail_id->user_id);?>
                                    <a href="{{url('profile/'.$detail->id)}}"><img class="post-avatar" id="profile_picture" height="40" width="40" title="{{{$detail->username}}}" src="{{asset('users/'.$detail->username.$detail->id.'/'.$detail->username.'image001.jpg')}}"></a>
                                @endforeach
                                </div>
                                <br>
                                <br>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')

<script type="text/javascript">
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

$('#profile_picture').mouseover(function(){
    
})


</script>

@stop


