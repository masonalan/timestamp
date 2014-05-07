@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">Searching posts for {{$query}}</a></h1>
    @foreach($found as $found_post)
    <?php $post = Post::find($found_post->id);
    $place = Location::find($post->location_id);?>
        <section class="post post-container-border">
                        <table class="post-header-table">
                            <tr>
                                <td>
                                    <a href="{{url("profile/$post->user_id")}}"><img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="60" width="60" src="{{asset('users/'.$post->user_info()->username.$post->user_info()->id.'/'.$post->user_info()->username.'image001.jpg')}}"></a>
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
                                        <span class="post-likes" title="{{$user->username}} likes this">{{$post->countLikes()}}</span>
                                        </button>
                                        
                                        <p class="post-meta">
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br> <span class="glyphicon glyphicon-time time"></span> <span class="time" id="countdown">
                                            
                                        @section('js')
                                        <script type="text/javascript">
                                                // set the date we're counting down to
                                            var target_date = new Date("{{date('M j, Y', $post->deleting_at)}}").getTime();
                                             
                                            // variables for time units
                                            var days, hours, minutes, seconds;
                                             
                                            // get tag element
                                            var countdown = document.getElementById("countdown");
                                             
                                            // update the tag with id "countdown" every 1 second
                                            setInterval(function () {
                                             
                                                // find the amount of "seconds" between now and target
                                                var current_date = new Date().getTime();
                                                var seconds_left = (target_date - current_date) / 1000;
                                             
                                                // do some time calculations
                                                days = parseInt(seconds_left / 86400);
                                                seconds_left = seconds_left % 86400;
                                                 
                                                hours = parseInt(seconds_left / 3600 + (days * 24));
                                                seconds_left = seconds_left % 3600;
                                                 
                                                minutes = parseInt(seconds_left / 60);
                                                seconds = parseInt(seconds_left % 60);
                                                 
                                                // format countdown string + set tag value
                                                countdown.innerHTML = hours + ":" + minutes + ":" + seconds;  
                                             
                                            }, 1000);
                                        </script>
                                        @stop
                                        </span>
                                        <br>
                                        <span>Stamped {{date('l F jS g:i A', strtotime($post->created_at))}}</span>
                                        <br>
                                        <a href="{{url('location/'.$post->location_id)}}"><span>{{$place->location}}</span></a>
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
                                            <center><img style="width:65%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @else
                                    <span>Image not found on server</span>
                                @endif
                            </p>
                        </div>
                        @foreach($post->replies()->get() as $reply)
                        <hr id="{{$reply->id}}">

                        <a href="{{url("profile/$reply->user_id")}}"><img class="post-avatar reply-avatar" alt="Tilo Mitra&#x27;s avatar" height="38" width="38" src="{{asset('users/'.$reply->user_info()->username.$reply->user_info()->id.'/'.$reply->user_info()->username.'image001.jpg')}}"></a>
                        <a href="{{url("profile/$reply->user_id")}}" class="post-author">{{{$reply->user->username}}}</a></span>
                        <br>
                        <p>
                            {{{$reply->content}}}
                            @if($reply->image_id == 1)
                                <?php 
                                list($width, $height) = getimagesize('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg');?>
                                <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
                                <br>
                                    <center><img style="width:50%;height:auto" class="{{$post->image_class}}" src="{{asset('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg')}}"></center>
                            @endif
                        </p>
                        @endforeach
                        <hr>
                            <div class="modal-comment">
                                <p>
                                    <form action="{{action('PostController@reply', array('post'=>$post->id))}}" method="POST" enctype="multipart/form-data">
                                    <input type="text" name="content" id="comment" class="focused-comment" placeholder="Reply...">
                                    <input type="hidden" value="false" name="has_image"></span>
                                    <div class="spacer-upload-button">
                                            <div class="fileUpload button-secondary pure-button">  
                                                    <span>Upload</span>
                                                    <input type="file" id="profile_image" name="post_img" class="upload" />
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
                                    <br><br>


                                    </form>
                                </p>
                            </div>
                    </section>
                    <br>
    @endforeach
    </div>
</div>
@stop