@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">Your search for {{{$query}}}</a></h1>
    @foreach($found as $found_user)
    <?php $found_info = User::orderBy('username', 'desc')->find($found_user->id);?>
        <a href="{{url('profile/'.$found_info->id)}}" class="follower-div-link"><div class="post-spacer-profile">
            <section class="post post-container-border recent-posts-right">
                    <table class="post-header-table">
                        <tr>
                            <td>
                            <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset('users/'.$found_info->username.$found_info->id.'/'.$found_info->username.'image001.jpg')}}">
                            </td>
                            <td>
                                <header class="post-header">
                                    
                                    <p class="post-meta">
                                    
                                        <h4>{{{$found_info->username}}}</h4>
                                    </p>
                                </header>
                            </td>
                        </tr>
                    </table>
            </section>
        </div></a>
    @endforeach
    </div>
</div>
@stop