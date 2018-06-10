<?php
/**
 * Created by PhpStorm.
 * User: RikuTakenaka
 * Date: 2018/05/01
 * Time: 23:26
 */

?>
<style>
  #map {
    width: 560px;
  }
</style>
<div id="map"></div>
<script>
  function initMap() {
    var uluru = {lat: 38.267435, lng: 140.878133};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: uluru,
      styles: [
        {
          "featureType": "all",
          "stylers": [
            { "saturation": -100 }
          ]
        }
      ]
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map,
      icon: "[gtdu]/library/images/1x/marker.png"
    });
  }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApGjVK_LsODGiGoIBxqedPploG_KbPEyk&callback=initMap">
</script>
