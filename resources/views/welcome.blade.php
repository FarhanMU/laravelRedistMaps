<!DOCTYPE html>
<html>

<head>
    <title>Google Maps Example</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        .search-panel {
            margin-top: 10px;
            text-align: center;
        }

        #search-input {
            width: 300px;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        #search-button {
            padding: 10px 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="search-panel">
        <input id="search-input" type="text" placeholder="Search for places">
        <button id="search-button">Search</button>
    </div>
    <div id="map"></div>
    <input id="latitude" placeholder="Latitude">
    <input id="longitude" placeholder="Longitude">

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=initMap" async defer></script>
    <script>
        let map, marker;
        function initMap() {
            const initialLocation = new google.maps.LatLng(-6.366322558664435, 107.17247102664571);
            map = new google.maps.Map(document.getElementById("map"), {
                center: initialLocation,
                zoom: 15,
            });
            marker = new google.maps.Marker({
                position: initialLocation,
                map: map
            });

            // Event listener for the search button
            document.getElementById('search-button').addEventListener('click', function() {
                let address = document.getElementById('search-input').value;
                fetch(`/search-location?address=${encodeURIComponent(address)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {
                        map.setCenter(new google.maps.LatLng(data.lat, data.lng));
                        marker.setPosition(new google.maps.LatLng(data.lat, data.lng));
                        document.getElementById('latitude').value = data.lat.toFixed(6);
                        document.getElementById('longitude').value = data.lng.toFixed(6);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + data.status);
                    }
                });
            });
        }
    </script>
</body>

</html>