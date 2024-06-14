# cara setting redist

pada .env rubah untuk settingan berikut ini :

-   REDIS_CLIENT=predis
-   REDIS_HOST=127.0.0.1
-   REDIS_PASSWORD=null
-   REDIS_PORT=6379

sesuaikan dengan settingan redist yang ada di docker atau local

# cara setting google maps

setting google maps api pada settingan berikut ini :

-   pada [welcome.blade.php] rubah pada tag <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=initMap"
        async defer></script> , replace YOUR_KEY dengan key google maps
-   pada [RedistController.php] rubah pada bagian [env('GOOGLE_MAPS_API_KEY')] ada pada .env [GOOGLE_MAPS_API_KEY] rubah menggunakan key google maps
