@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">People Following {{$userProf->username}}</a></h1>
    @foreach($userProf->followed()->get() as $follower)
    <?php $follower_info = User::orderBy('username', 'desc')->find($follower->follower_user_id);?>

    @if(empty($follower_info))
    		<section class="post post-container-border">
		            <table class="post-header-table">
		                <tr>
		                    <td>
		                    	<header class="post-header">
		                    		
			                    	<p class="post-meta">
			                    	
			                    		<h4>{{$follower_info->username}} is not followed by anyone</h4>
			                    	</p>
		                    	</header>
		                    </td>
		                </tr>
		            </table>
			</section>
    @else
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
			                    	
			                    		<h4>{{$follower_info->username}}</h4>
			                    	</p>
		                    	</header>
		                    </td>
		                </tr>
		            </table>
			</section>
		</div></a>
	@endif
	@endforeach
	</div>
</div>
@stop