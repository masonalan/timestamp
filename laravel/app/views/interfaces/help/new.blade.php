@extends('template')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div>
            <section class="post">
                <table class="post-header-table" id="stamps">
                    <tr>
                        <td>
                        	<img class="post-avatar" id="profile_picture" height="48" width="48" src="{{asset('timestampprof.png')}}">
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
                            

                                <p class="post-meta">
                                	<span class="post-author"><h4>Welcome to Timestamp, {{$user->username}}.</h4></span>
                                </p>
                            </header>
                        </td>
                    </tr>
                </table>
                <hr>
                <p class="help-desk-text">
                    Because you are relatively new to this site, we are providing you with the knowledge that can aid you get around our site better. 
                    <br><br>
                    <h4>Search:</h4>
                    There are multiple ways to search on Timestamp. You can coduct a user search, a search for a location or a search for a tag. 
                    <br><br>
                    Timestamp uses different kinds of search identifiers. 
                    <br><br>
                    Here are all of the indentifiers:
                    <span style="color:red">@</span>, <span style="color:red">_</span>, <span style="color:red">#</span>, <span style="color:red">.</span>
                    <br><br>
                    Each indentifier identifies what type of thing that you the user are searching for.
                    <br><br>
                    <span class="indentifier-text">User: </span>The <span style="color:red">@</span> indentifier means that you are searching for a <span style="color:red">user</span>. You can also search for a user without any indentifier.
                    <br>
                    <span class="indentifier-text">ex: </span> <span style="color:red">@</span>user OR user
                    <br><br>
                    <span class="indentifier-text">Location: </span>The <span style="color:red">_</span> indentifier means that you are searching for a <span style="color:red">location</span>. When your location is found, you can click on it to see all the stamps in its area.
                    <br>
                    <span class="indentifier-text">ex: </span> <span style="color:red">_</span>philadelphia
                    <br><br>
                    <span class="indentifier-text">Tags: </span>The <span style="color:red">#</span> indentifier means that you are searching for a <span style="color:red">tag</span>. When your tag is found, you can click on it to see all the stamps using the tag.
                    <br>
                    <span class="indentifier-text">ex: </span> <span style="color:red">#</span>example
                    <br><br>
                    <span class="indentifier-text">Post: </span>The <span style="color:red">.</span> indentifier means that you are searching <span style="color:red">stamp content</span>. Your search will return any stamps that have a string like your search query.
                    <br>
                    <span class="indentifier-text">ex: </span> <span style="color:red">.</span>example
                    <br><br>

                </p>







@stop