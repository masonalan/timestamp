@extends('template')
@section('content')
<?php $location = Location::where('post_id', '=', $post->id)->get();?>
<div class="content-wrapper">
    <div class="content">
        <div>


            <div class=" recent">
            <?php 

            /*
            $timezone = Config::get('app.timezone', 'EST');
            if(date('l F jS g:i A', strtotime($post->created_at))>date('l F jS g:i A')){
                $posted_time = $post->created_at;
                dd($strtotime($posted_time));
                DB::table('posts')->where("strtotime($posted_time)", ">", "172800")->delete();
            }

            */
            ?>
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
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br><span class="time">2d 5h <span class="glyphicon glyphicon-time"></span></span>
                                        <br>
                                        <span>Stamped {{date('l F jS g:i A', strtotime($post->created_at))}}</span>
                                        <br>
                                        <span><script type="text/javascript">$('#compact').countdown({until: {{12/21/21}}, compact: true,description: ''});</script></span>
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
                                            <center><img style="width:50%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @else
                                    <span>Image not found on server</span>
                                @endif
                            </p>
                        </div>
                        @foreach($post->replies()->get() as $reply)
                        <hr>

                        <a href="{{url("profile/$reply->user_id")}}"><img class="post-avatar reply-avatar" alt="Tilo Mitra&#x27;s avatar" height="38" width="38" src="{{asset('users/'.$reply->user_info()->username.$reply->user_info()->id.'/'.$reply->user_info()->username.'image001.jpg')}}"></a>
                        <a href="{{url("profile/$reply->user_id")}}" class="post-author">{{{$reply->user->username}}}</a></span>
                        <br>
                        <p>
                            {{{$reply->content}}}
                        </p>
                        @endforeach
                        <hr>
                            <div class="modal-comment">
                                <p>
                                    <form action="{{action('PostController@reply', array('post'=>$post->id))}}" method="POST">

                                    <input type="text" name="content" id="comment" placeholder="Reply...">

                                    </form>
                                </p>
                            </div>
                    </section>
                    
                </div>
</div>
</div>
</div>
            
@stop