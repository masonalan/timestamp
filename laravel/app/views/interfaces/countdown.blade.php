@extends('feed')
@section('post_count_down')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.timer').countdown({
				target: "October 31, 2015 00:00:00", 
				parts: ['days', 'hours', 'minutes', 'seconds'],
				separator: ":",
				leadingZero: true
			});
		});
	</script>
@stop