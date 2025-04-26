<x-app-layout>
    @push('css')
        <x-leaflet-styles/>
        <style>
            #map {
                height: 500px;
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Точка
        </h2>
    </x-slot>

    <div class="container mx-auto py-3">
        <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div id="map"></div>
        </div>

        <div class="my-3">
            <a href="{{route('admin-check-users')}}"
               class="inline-block rounded bg-info px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Назад
            </a>
        </div>
    </div>

    @push('js')
        <x-leaflet-scripts/>

        <script type="module">
            //    Initialize Map
            let userId = {{Js::from($id)}};
            const

                map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14);
            var meIcon = L.icon({
                iconUrl: '/images/man_point.png',
                iconSize:     [40, 40], // size of the icon
                shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [20, 40], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 25}).addTo(map);
            Echo.private("user-location." +userId).listen(".App\\Events\\UserLocation",function (e) {
                        recreateMap(e);
             });


            function recreateMap(data){
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        map.removeLayer(layer);
                    }
                });
                if(data.location){
                    let location = JSON.parse(data.location);
                    L.marker([location.lat, location.lng],{icon:meIcon}).addTo(map);
                    map.flyTo([location.lat, location.lng], 18);
                }


            }


        </script>
    @endpush
</x-app-layout>

