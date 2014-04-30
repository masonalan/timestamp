@extends('template')
@section('content')
<?php
$tweet = "this has a #hashtag a  #badhash-tag and a #goodhash_tag";


preg_match_all("/(#\w+)/", $tweet, $matches);
echo "$tweet";

?>

<div class="content-wrapper">
    <div class="content">
        <div>
            <h1 class="post-tabs"><a class="recent-link" href="javascript:sort('recent')">recent</a> <a class="top-link" href="javascript:sort('top')">popular</a></h1>
            <!--<a class="suggested-link" target="_blank" href="http://bit.ly/1fgJVRa"><div class="suggested-left">
                <section class="post post-container-border">
                <table class="post-header-table">
                    <tr>
                        <td>
                            <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="{{asset('ads/staples.png')}}"></a>
                        </td>
                        <td>
                            <header class="post-header ad">
                            <br>
                            <h4>Staples</h4>
                            </header>
                        </td>
                    </tr>
                </table>
                
                </section>
            </div></a>-->
            <div class="recent-posts-left">
            </div>
            <div class="recent-posts-right">
            </div>
            <div class="recent-posts">
            <?php $counter = 0;
            $tracker=0; ?>
            @foreach($recent_posts as $post)
            @if ($counter%2==0)
            <div class="post-spacer-left recent">
            @else
            <div class="post-spacer-right recent">
            @endif
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
                                    <a href="{{url("profile/$post->user_id")}}"><img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="{{asset('users/'.$post->user_info()->username.$post->user_info()->id.'/'.$post->user_info()->username.'image001.jpg')}}"></a>
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
                                        <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br><span class="time"> <span class="glyphicon glyphicon-time"></span></span>
                                        <br>
                                        <span>Stamped {{date('l F jS g:i A', strtotime($post->created_at))}}</span>
                                        </p>
                                    </header>
                                </td>
                            </tr>
                        </table>
                        

                        <a href="{{url('post/'.$post->id)}}" class="tab-post-links"><div class="post-description">
                            <p>
                                {{{$post->content}}}
                                @if(file_exists('post_img'))
                                    @if($post->image_id == 1)
                                        <?php 
                                        list($width, $height) = getimagesize('post_img/'.$post->id.'/'.$post->id.'image001.jpg');?>
                                        <link rel="stylesheet" type="text/css" href="{{asset('image.css')}}">
                                            
                                            <center><img style="width:100%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @else
                                    <span>Image not found on server</span>
                                @endif
                            </p>
                        </a>
                        </div>
                        @foreach($post->replies()->take(3)->orderBy('id', 'desc')->get() as $reply)
                        <?php 
                        $tracker++;
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
                        <hr>
                            <div class="modal-comment">
                                <p>
                                    <form action="{{action('PostController@reply', array('post'=>$post->id))}}" method="POST" enctype="multipart/form-data">
                                    <input type="text" name="content" id="comment" placeholder="Reply...">
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
                    
                </div>
            <?php $counter++; ?>
            @endforeach
            </div>
            <div class="top-posts">
            <?php $counter = 0; ?>
            @foreach($top_posts as $post)
            @if ($counter%2==0)
            <div class="post-spacer-left top">
            @else
            <div class="post-spacer-right top">
            @endif
            <?php $counter++; ?>
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
                                    <span class="post-likes" title="{{$user->username}} likes this" >{{$post->countLikes()}}</span>
                                    </button>

                                    <p class="post-meta">
                                    <a href="{{url("profile/$post->user_id")}}" class="post-author">{{{$post->username()}}}</a> <br><span class="time">2d 5h <span class="glyphicon glyphicon-time"></span></span>
                                    <br>
                                    <span>Stamped {{date('l F jS g:i A', strtotime($post->created_at))}}</span>
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
                                            <center><img style="width:100%;height:auto" class="{{$post->image_class}}" src="{{asset('post_img/'.$post->id.'/'.$post->id.'image001.jpg')}}"></center>
                                    @endif
                                @else
                                    <span>Image not found on server</span>
                                @endif
                        </p>
                    </div>
                </section>
            </div>
            @endforeach
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
function sort(way){
    if (way == 'recent') {
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
        $('.top-posts').hide();
        $('.recent-posts').show();
        $('.recent-link').css('text-decoration', 'underline');
        $('.top-link').css('text-decoration', 'none');
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
        $('.recent-posts').hide();
        $('.top-posts').show();
        $('.recent-link').css('text-decoration', 'none');
        $('.top-link').css('text-decoration', 'underline');
    }
}
$(document).ready(function(){
    sort('recent');
});
</script>

@stop


