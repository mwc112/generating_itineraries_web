<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLdNmTVBAkJC-GYP8SS51Fa-dG8DyvLSQ&callback=initMap"
            async defer></script>
    <script>
      var map;
      var directionsDisplay;
      var directionsService;
      var geocoder;

			function create_markers(waypoints, num_waypoints) {
        for(i = 0; i < num_waypoints; i++) {
            geocoder.geocode({
                                placeId: waypoints[i]
                             },
                             function(results, status) {
                                if(status == google.maps.GeocoderStatus.OK) {
                                    var marker = new google.maps.Marker({
                                                                            position: results[0].geometry.location,
                                                                            map: map,
                                                                            title: "Hello!"
                                                                         });
                                    var infowindow = new google.maps.InfoWindow({
                                                                                content: results[0].address_components[0].short_name
                                                                                });
                                    marker.addListener('click', function(){
                                                                          infowindow.open(map, marker);
                                                                          });
																		map.setCenter(results[0].geometry.location);
																		map.setZoom(15);
                                }
																else {
																}

                             });
        }
      }

      function get_dir(waypoints, num_waypoints, hotel) {
        var d_wps = [];

        for(i = 0; i < num_waypoints; i++) {
            d_wps.push({
                            location: {
                                            placeId: waypoints[i]
                                      },
                            stopover: true
                      });
        }

        var request = {
            origin: hotel,
            destination: hotel,
            travelMode: google.maps.TravelMode.TRANSIT
            };
        directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(result);
            }
        });
      }

      function initMap() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        //directionsService = new google.maps.DirectionsService();
        geocoder = new google.maps.Geocoder;

				 map = new google.maps.Map(document.getElementById('map-canvas'), {
         center: {lat: 51.507351, lng: -0.127758},
         zoom: 8
         });
         directionsDisplay.setMap(map);

      }
    </script>
</head>
<body>
<div id="map-canvas"></div>
<script>

</script>
</body>
</html>


