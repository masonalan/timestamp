@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">Posts from {{$place}}</a></h1>
    @foreach($posts as $post)

		<a href="{{url('post/'.$post->id)}}" class="tab-post-links">
			<section class="post post-container-border recent-posts-right">
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
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br><span class="time">2d 5h <span class="glyphicon glyphicon-time"></span></span>
                                        <br>
                                        <span>Stamped {{date('l F jS g:i A', strtotime($post->created_at))}}</span>
                                        <br>
                                        <span><script type="text/javascript">$('#compact').countdown({until: {{12/21/21}}, compact: true,description: ''});</script></span>
                                        <a href="{{url('location/'.$post->location_id)}}"><span>{{$place}}</span></a>
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
                        @foreach($post->replies()->take('10')->get() as $reply)
                        <hr id="{{$reply->id}}">

                        <a href="{{url("profile/$reply->user_id")}}"><img class="post-avatar reply-avatar" alt="Tilo Mitra&#x27;s avatar" height="38" width="38" src="{{asset('users/'.$reply->user_info()->username.$reply->user_info()->id.'/'.$reply->user_info()->username.'image001.jpg')}}"></a>
                        <a href="{{url("profile/$reply->user_id")}}" class="post-author">{{{$reply->user->username}}}</a></span>
                        <br>
                        <a class="tab-post-links" href="{{url('post/'.$post->id.'#'.$reply->id)}}"><p>
                            {{{$reply->content}}}
                            @if($reply->image_id == 1)
                                <?php 
                                list($width, $height) = getimagesize('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg');?>
                                <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
                                <br>
                                    <center><img style="width:40%;height:auto" class="{{$post->image_class}}" src="{{asset('reply_img/'.$reply->id.'/'.$reply->id.'reply001.jpg')}}"></center>
                            @endif
                        </p></a>
                        @endforeach
                        @if(time() - $post->deleting_at < 604800)
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
                        @endif
                    </section>
		</a><br>
	@endforeach
	</div>
</div>
@stop