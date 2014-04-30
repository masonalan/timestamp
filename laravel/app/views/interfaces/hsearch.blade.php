@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
    <h1 class="post-tabs"><a class="recent-link follower-page">Your search for #{{$query}}</a></h1>
        <a href="{{url('feed')}}" class="follower-div-link"><div class="post-spacer-profile">
            <section class="post post-container-border">
                    <table class="post-header-table">
                        <tr>
                            <td>
                            <img class="post-avatar" id="profile_picture" height="70" width="70" src="{{asset('comingsoon.png')}}">
                            </td>
                            <td>
                                <header class="post-header">
                                    
                                    <p class="post-meta">
                                    
                                        <h4>#hashtags are not implemented yet...</h4>
                                    </p>
                                </header>
                            </td>
                        </tr>
                    </table>
            </section>
        </div></a>
    </div>
</div>
@stop