@extends('template')
@section('content')
<?php
$tweet = "this has a #hashtag a  #badhash-tag and a #goodhash_tag";

preg_match_all("/(#\w+)/", $tweet, $matches);

?>
<head>
    <link rel="stylesheet" media="all" href="world/jquery-jvectormap.css"/>
<script src="world/assets/jquery-1.8.2.js"></script>
<script src="world/jquery-jvectormap.js"></script>
<script src="world/jquery-mousewheel.js"></script>

<script src="world/lib/jvectormap.js"></script>

<script src="world/lib/abstract-element.js"></script>
<script src="world/lib/abstract-canvas-element.js"></script>
<script src="world/lib/abstract-shape-element.js"></script>

<script src="world/lib/svg-element.js"></script>
<script src="world/lib/svg-group-element.js"></script>
<script src="world/lib/svg-canvas-element.js"></script>
<script src="world/lib/svg-shape-element.js"></script>
<script src="world/lib/svg-path-element.js"></script>
<script src="world/lib/svg-circle-element.js"></script>

<script src="world/lib/vml-element.js"></script>
<script src="world/lib/vml-group-element.js"></script>
<script src="world/lib/vml-canvas-element.js"></script>
<script src="world/lib/vml-shape-element.js"></script>
<script src="world/lib/vml-path-element.js"></script>
<script src="world/lib/vml-circle-element.js"></script>

<script src="world/lib/vector-canvas.js"></script>
<script src="world/lib/simple-scale.js"></script>
<script src="world/lib/numeric-scale.js"></script>
<script src="world/lib/ordinal-scale.js"></script>
<script src="world/lib/color-scale.js"></script>
<script src="world/lib/data-series.js"></script>
<script src="world/lib/proj.js"></script>
<script src="world/lib/world-map.js"></script>
</head>

<div class="content-wrapper">
    <div class="content">
    <div style="height: 100%;width:100%;"></div>
  <div id="map1" style="width: 100%; height: 500px"></div>
  <button id="focus-single">Focus on Australia</button>
  <button id="focus-multiple">Focus on Australia and Japan</button>
  <button id="focus-init">Return to the initial state</button>
</div>
</div>

@section('js')
<script>
    jQuery.noConflict();
    jQuery(function(){
      var $ = jQuery;

      $('#focus-single').click(function(){
        $('#map1').vectorMap('set', 'focus', 'AU');
      });
      $('#focus-multiple').click(function(){
        $('#map1').vectorMap('set', 'focus', ['AU', 'JP']);
      });
      $('#focus-init').click(function(){
        $('#map1').vectorMap('set', 'focus', 1, 0, 0);
      });
      $('#map1').vectorMap({
        map: 'world_mill_en',
        focusOn: {
          x: 0.5,
          y: 0.5,
          scale: 2
        },
        series: {
          regions: [{
            scale: ['#C8EEFF', '#0071A4'],
            normalizeFunction: 'polynomial',
            values: {
              "AF": 16.63,
              "AL": 11.58,
              "DZ": 158.97,
              "AO": 85.81,
              "AG": 1.1,
              "AR": 351.02,
              "AM": 8.83,
              "AU": 1219.72,
              "AT": 366.26,
              "AZ": 52.17,
              "BS": 7.54,
              "BH": 21.73,
              "BD": 105.4,
              "BB": 3.96,
              "BY": 52.89,
              "BE": 461.33,
              "BZ": 1.43,
              "BJ": 6.49,
              "BT": 1.4,
              "BO": 19.18,
              "BA": 16.2,
              "BW": 12.5,
              "BR": 2023.53,
              "BN": 11.96,
              "BG": 44.84,
              "BF": 8.67,
              "BI": 1.47,
              "KH": 11.36,
              "CM": 21.88,
              "CA": 1563.66,
              "CV": 1.57,
              "CF": 2.11,
              "TD": 7.59,
              "CL": 199.18,
              "CN": 5745.13,
              "CO": 283.11,
              "KM": 0.56,
              "CD": 12.6,
              "CG": 11.88,
              "CR": 35.02,
              "CI": 22.38,
              "HR": 59.92,
              "CY": 22.75,
              "CZ": 195.23,
              "DK": 304.56,
              "DJ": 1.14,
              "DM": 0.38,
              "DO": 50.87,
              "EC": 61.49,
              "EG": 216.83,
              "SV": 21.8,
              "GQ": 14.55,
              "ER": 2.25,
              "EE": 19.22,
              "ET": 30.94,
              "FJ": 3.15,
              "FI": 231.98,
              "FR": 2555.44,
              "GA": 12.56,
              "GM": 1.04,
              "GE": 11.23,
              "DE": 3305.9,
              "GH": 18.06,
              "GR": 305.01,
              "GD": 0.65,
              "GT": 40.77,
              "GN": 4.34,
              "GW": 0.83,
              "GY": 2.2,
              "HT": 6.5,
              "HN": 15.34,
              "HK": 226.49,
              "HU": 132.28,
              "IS": 12.77,
              "IN": 1430.02,
              "ID": 695.06,
              "IR": 337.9,
              "IQ": 84.14,
              "IE": 204.14,
              "IL": 201.25,
              "IT": 2036.69,
              "JM": 13.74,
              "JP": 5390.9,
              "JO": 27.13,
              "KZ": 129.76,
              "KE": 32.42,
              "KI": 0.15,
              "KR": 986.26,
              "KW": 117.32,
              "KG": 4.44,
              "LA": 6.34,
              "LV": 23.39,
              "LB": 39.15,
              "LS": 1.8,
              "LR": 0.98,
              "LY": 77.91,
              "LT": 35.73,
              "LU": 52.43,
              "MK": 9.58,
              "MG": 8.33,
              "MW": 5.04,
              "MY": 218.95,
              "MV": 1.43,
              "ML": 9.08,
              "MT": 7.8,
              "MR": 3.49,
              "MU": 9.43,
              "MX": 1004.04,
              "MD": 5.36,
              "MN": 5.81,
              "ME": 3.88,
              "MA": 91.7,
              "MZ": 10.21,
              "MM": 35.65,
              "NA": 11.45,
              "NP": 15.11,
              "NL": 770.31,
              "NZ": 138,
              "NI": 6.38,
              "NE": 5.6,
              "NG": 206.66,
              "NO": 413.51,
              "OM": 53.78,
              "PK": 174.79,
              "PA": 27.2,
              "PG": 8.81,
              "PY": 17.17,
              "PE": 153.55,
              "PH": 189.06,
              "PL": 438.88,
              "PT": 223.7,
              "QA": 126.52,
              "RO": 158.39,
              "RU": 1476.91,
              "RW": 5.69,
              "WS": 0.55,
              "ST": 0.19,
              "SA": 434.44,
              "SN": 12.66,
              "RS": 38.92,
              "SC": 0.92,
              "SL": 1.9,
              "SG": 217.38,
              "SK": 86.26,
              "SI": 46.44,
              "SB": 0.67,
              "ZA": 354.41,
              "ES": 1374.78,
              "LK": 48.24,
              "KN": 0.56,
              "LC": 1,
              "VC": 0.58,
              "SD": 65.93,
              "SR": 3.3,
              "SZ": 3.17,
              "SE": 444.59,
              "CH": 522.44,
              "SY": 59.63,
              "TW": 426.98,
              "TJ": 5.58,
              "TZ": 22.43,
              "TH": 312.61,
              "TL": 0.62,
              "TG": 3.07,
              "TO": 0.3,
              "TT": 21.2,
              "TN": 43.86,
              "TR": 729.05,
              "TM": 0,
              "UG": 17.12,
              "UA": 136.56,
              "AE": 239.65,
              "GB": 2258.57,
              "US": 14624.18,
              "UY": 40.71,
              "UZ": 37.72,
              "VU": 0.72,
              "VE": 285.21,
              "VN": 101.99,
              "YE": 30.02,
              "ZM": 15.69,
              "ZW": 5.57
            }
          }]
        }
      });
    })
  </script>
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


