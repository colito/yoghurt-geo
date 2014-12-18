<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Geocoding service</title>
    <style>
        html, body, #map-canvas {
            height: 100%;
            margin: 0px;
            padding: 0px
        }
        #panel {
            position: absolute;
            top: 5px;
            left: 50%;
            margin-left: -180px;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
        var geocoder;
        var map;
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-26.177592, 28.134668);
            var mapOptions = {
                zoom: 15,
                center: latlng
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        }

        function codeAddress() {
            var address = document.getElementById('address').value;
            console.log('Address : ' + address);
            geocoder.geocode( { 'address': address}, function(results, status) {
                console.log('Status : ' + status);
                console.log('Long Name 1 : ' + results[0]['address_components'][0]['long_name']);
                console.log('Long Name 2 : ' + results[0]['address_components'][1]['long_name']);
                console.log('Formatted Address : ' + results[0]['formatted_address']);
                console.log('Lattitude : ' + results[0]['geometry']['location']['k']);
                console.log('Longitude : ' + results[0]['geometry']['location']['B']);
                //alert(JSON.stringify(results[0], null, 4));
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>
<body>
<div id="panel">
    <input id="address" type="textbox" value="bedfordview">
    <input type="button" value="Geocode" onclick="codeAddress()">
</div>
<div id="map-canvas"></div>
</body>
</html>