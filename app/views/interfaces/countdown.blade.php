@extends('feed')
@section('post_count_down')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.timer').countdown({
				target: "{{$post->deleting_at}}", 
				parts: ['days', 'hours', 'minutes', 'seconds'],
				separator: ":",
				leadingZero: true
			});
		});
	</script>
@stop