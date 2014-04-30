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
                                	<span class="post-author">timestamp</span>
                                </p>
                            </header>
                        </td>







@stop