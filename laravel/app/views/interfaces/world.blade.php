@extends('template')
@section('content')
<?php
$tweet = "this has a #hashtag a  #badhash-tag and a #goodhash_tag";

preg_match_all("/(#\w+)/", $tweet, $matches);

?>

<div class="content-wrapper">
    <div class="content">
            
            <!-- 
                You need to include this script on any page that has a Google Map.
                When using Google Maps on your own site you MUST signup for your own API key at:
                    https://developers.google.com/maps/documentation/javascript/tutorial#api_key
                After your sign up replace the key in the URL below or paste in the new script tag that Google provides.
            -->
   
          <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->

            <!DOCTYPE html>
<html>
    <head>
        
        <style type="text/css">
            /* Set a size for our map container, the Google Map will take up 100% of this container */
            #map {
                height: 750px;
                width: 1000px;
            }
            .content {
                width: 90% !important;
                height: 90% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            #map {
                position: relative !important;
            }
        </style>
        
        <!-- 
            You need to include this script on any page that has a Google Map.
            When using Google Maps on your own site you MUST signup for your own API key at:
                https://developers.google.com/maps/documentation/javascript/tutorial#api_key
            After your sign up replace the key in the URL below or paste in the new script tag that Google provides.
        -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>
        
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
            google.maps.Map.prototype.clearMarkers = function() {
                for(var i=0; i < this.markers.length; i++){
                    this.markers[i].setMap(null);
                }
                this.markers = new Array();
            };
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 2,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"stylers":[{"visibility":"off"}]},{"featureType":"road","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road.arterial","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"road.highway","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"landscape","stylers":[{"visibility":"on"},{"color":"#f3f4f4"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#7fc8ed"}]},{},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#83cead"}]},{"elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"weight":0.9},{"visibility":"off"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using out element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);
            }
        </script>
    </head>
    <body>

        <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->
        <div id="map" height="100%" width="100%" ></div>
    </body>
</html>

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



