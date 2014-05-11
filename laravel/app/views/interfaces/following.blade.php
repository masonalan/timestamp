@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">People {{{$userProf->username}}} is following</a></h1>
    @foreach($info as $follower)
    <?php $follower_info = User::orderBy('username', 'desc')->find($follower->user_id);?>

    	@if(!empty($checker))
    	<a href="{{url('profile/'.$follower_info->id)}}" class="follower-div-link"><div class="post-spacer-profile">
		    <section class="post post-container-border">
		            <table class="post-header-table">
		                <tr>
		                    <td>
		                    <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset('users/'.$follower_info->username.$follower_info->id.'/'.$follower_info->username.'image001.jpg')}}">
		                    </td>
		                    <td>
		                    	<header class="post-header">
		                    		
			                    	<p class="post-meta">
			                    	
			                    	
			                    		<h4>{{{$follower_info->username}}}</h4>
			                    	</p>
		                    	</header>
		                    </td>
		                </tr>
		            </table>
			</section>
		</div></a>
    	@else
    	<div class="post-spacer-profile"><section class="post post-container-border">
		            <table class="post-header-table">
		                <tr>
		                    <td>
		                    	<header class="post-header">
		                    		
			                    	<p class="post-meta">
			                    	<?php var_dump($info_check);?>
			                    		<h4>{{{$user->username}}} is not following anyone</h4>
			                    	</p>
		                    	</header>
		                    </td>
		                </tr>
		            </table>
			</section></div>
		
		@endif
	@endforeach
	</div>
</div>
@stop