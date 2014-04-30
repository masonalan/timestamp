@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">Your regional search for {{$query}}</a></h1>
    @foreach($found as $found_location)
    <?php $found_info = Location::find($found_location->id);?>
        <a href="{{url('location/'.$found_info->id)}}" class="follower-div-link"><div class="post-spacer-profile">
            <section class="post post-container-border">
                    <table class="post-header-table">
                        <tr>
                            <td>
                                <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset('location.jpg')}}">
                            </td>
                            <td>
                                <header class="post-header">
                                    
                                    <p class="post-meta">
                                    
                                        <h4>{{$found_info->location}}</h4>
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