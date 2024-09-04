<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time GPS Phone Tracking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            color: #007BFF;
        }
        #tracker {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            border-radius: 8px;
        }
        #locationDetails {
            margin-top: 20px;
            text-align: left;
        }
        #locationDetails p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div id="tracker">
        <h1>Real-Time GPS Phone Tracking System</h1>
        <p>Enter your IMEI number to start tracking your phone:</p>
        <input type="text" id="imeiInput" placeholder="Enter IMEI number">
        <button onclick="startTracking()">Start Tracking</button>

        <div id="locationDetails">
            <p><strong>Latitude:</strong> <span id="latitude">N/A</span></p>
            <p><strong>Longitude:</strong> <span id="longitude">N/A</span></p>
        </div>

        <div id="map"></div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
    <script>
        let map, marker, watchId;

        function initMap(lat, lng) {
            const location = { lat, lng };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }

        function updateMap(lat, lng) {
            const location = { lat, lng };
            map.setCenter(location);
            marker.setPosition(location);
        }

        function startTracking() {
            const imei = document.getElementById('imeiInput').value;

            if (!imei) {
                alert('Please enter a valid IMEI number.');
                return;
            }

            if (navigator.geolocation) {
                watchId = navigator.geolocation.watchPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        if (!map) {
                            initMap(lat, lng);
                        } else {
                            updateMap(lat, lng);
                        }

                        // Update location details in the HTML
                        document.getElementById('latitude').innerText = lat.toFixed(6);
                        document.getElementById('longitude').innerText = lng.toFixed(6);
                    },
                    (error) => {
                        alert('Error getting location: ' + error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function stopTracking() {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                alert("Tracking stopped.");
            }
        }
    </script>
</body>
</html>
  