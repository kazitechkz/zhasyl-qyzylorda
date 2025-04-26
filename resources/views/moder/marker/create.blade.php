<x-app-layout>
    @push('css')
        <x-leaflet-styles/>
        <style>
            #map {height: 300px}
            select {width: 100%}
            /*#geo_denied {display: none}*/
        </style>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Посадить дерево</h1>
        <div class="mb-4" id="geo_permission">
            <div class="mb-2">
                @error('geocode')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div id='map' class="position-relative">

                </div>
            </div>

            <div class="modal-block">
                <form id="createMarkerPointForm" action="{{route('trees.store')}}" method="post">
                    @csrf
                    <livewire:moder.modal-marker />
                    <input type="hidden" id="geo" name="geocode[]">
                    <input type="hidden" name="place_id" value="{{$place->id}}">
                    <input type="hidden" name="area_id" value="{{$place->area->id}}">
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">
                    <div class="mb-2">
                        <button
                            id="buttonSendMarker"
                            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                            Сохранить
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('js')
        <x-leaflet-scripts/>
            <script type="module">
            //    Initialize Map
            var userId = {{\Illuminate\Support\Facades\Auth::id()}};
            var activeGeoPlace = [];
            let toggleShow = false;
            let dataTree = [];
            let maxZoom = 16;
            const currentPosition = [],
                area = {{Js::from($place->area)}},
                place = {{Js::from($place)}},
                markers = {{Js::from([])}},
                map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14),
                cable = L.geoJSON(JSON.parse(place.geocode), {
                    style: {
                        color: place.bg_color
                    },
                    onEachFeature: function (feature, layer) {
                        activeGeoPlace.push(layer);
                    },
                }).addTo(map),
                greenIcon = L.icon({
                    iconUrl: '/images/leaf-green.png',
                    shadowUrl: '/images/leaf-shadow.png',
                    iconSize:     [38, 95], // size of the icon
                    shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                }),
                meIcon = L.icon({
                    iconUrl: '/images/man_point.png',
                    iconSize:     [40, 40], // size of the icon
                    shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [20, 40], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                }),
                MARKERS_MAX = 20;
                let MARKERS_DATA = [];
            cable.pm.setOptions({
                allowEditing:false,
                allowRemoval:false,
                allowCutting:false,
                allowRotation:false,
            });
                let search_polygon;
                let drawMode = true;

                map.fitBounds(cable.getBounds());
            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
                drawCircleMarker:false,
                tooltips:false,
                drawPolyline:false,
                dragMode:false,
                cutPolygon:false,
                drawPolygon:false,
                drawRectangle:false,
                drawText:false,
                editMode:false,
                drawMarker:false,
                rotateMode:false
            });
            map.pm.Toolbar.createCustomControl({
                name:"showAll",
                title:"Показать ранее посаженные деревья",
                className: "fas fa-eye fs-5",
                afterClick:()=>{toggleShowAction();},
            });
            map.pm.Toolbar.createCustomControl({
                name:"geoPosition",
                title:"Показать ранее посаженные деревья",
                className: "fas fa-location fs-5",
                afterClick:()=>{getMyCurrentPosition();},
            });
            window.onload = function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(setPosition);
                    navigator.geolocation.watchPosition(function (e) {
                        map.eachLayer(function (mapItem){
                            if(mapItem.options && mapItem.options.title == "me"){
                                mapItem.remove();
                            }
                        })
                        let coordinates = JSON.stringify({"lat":e.coords.latitude,"lng":e.coords.longitude});
                        axios.get('/api/get-user-location/'+userId+'/'+ coordinates +'').then(response => {});
                        let marker = L.marker([e.coords.latitude,e.coords.longitude],{icon:meIcon,title:"me"}).addTo(map);

                    });
                } else {
                    alert("Geolocation not supported by browser.");
                }

            };
            function getMyCurrentPosition(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        map.setView([position.coords.latitude,position.coords.longitude], 19);
                    });
                } else {
                    alert("Геолокация не поддерживается браузером.");
                }
            }
            // a layer group, used here like a container for markers
            var markersGroup = L.layerGroup();
            map.addLayer(markersGroup);
            if(markers.length<100){
                markers.forEach(function (marker) {
                    L.marker(JSON.parse(marker.geocode)).addTo(map)
                })
            }

            function errorCallBack() {
                $('#geo_permission').css('display', 'none');
                $('#geo_denied').css('display', 'block');
            }

            function setPosition(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                currentPosition['lat'] = latitude;
                currentPosition['lng'] = longitude;
                $('#lat').attr('value', JSON.stringify(latitude))
                $('#lng').attr('value', JSON.stringify(longitude))
            }

            map.on('click', function(e) {
                // get the count of currently displayed markers
                const markersCount = markersGroup.getLayers().length;
                if (markersCount < MARKERS_MAX && drawMode) {
                    var marker = L.marker(e.latlng, {title:"point"});
                    if(checkInBounds(marker)){
                        if(marker.options.title == "point"){
                            marker.addTo(markersGroup);
                            marker.on("pm:remove",function ({	layer, shape})
                                {
                                    markersGroup.removeLayer(layer["_leaflet_id"]);
                                    let index = MARKERS_DATA.indexOf(layer.getLatLng());
                                    if(index > -1){
                                        MARKERS_DATA.splice(index, 1);
                                    }
                                    markersGroup = markersGroup.eachLayer(function (itemLayer) {
                                       if(itemLayer.getLatLng() == layer.getLatLng()){
                                           itemLayer.remove();
                                       }
                                    });
                                    $('#geo').attr('value', MARKERS_DATA.length > 0 ? JSON.stringify(MARKERS_DATA) : null);
                                }
                            )
                        }
                        markersGroup.getLayers().forEach(function (e){
                            if (!MARKERS_DATA.includes(e.getLatLng()) && e.options.title == "point") {
                                MARKERS_DATA.push(e.getLatLng());
                                marker = null;
                            }
                        });
                    }
                }
                $('#geo').attr('value', MARKERS_DATA.length > 0 ? JSON.stringify(MARKERS_DATA) : null);
                if(markersCount > MARKERS_MAX){
                    alert("Превышено допустимое число более 20");
                }
                // remove the markers when MARKERS_MAX is reached
            });
            map.on("zoomend",function (event) {
                getSearchPolygon(event);
            })

            map.on("moveend",function (event) {
                getSearchPolygon(event);
            })

            map.on("pm:globalremovalmodetoggled", ({enabled, map}) => {
                drawMode = !enabled;
            });

            //Check if in selectedArea
            function checkInBounds(layer){
                if(activeGeoPlace.some((geoLayer)=>{
                        if(turf.booleanContains(geoLayer.toGeoJSON(),layer.toGeoJSON())){
                            return true;
                        }
                })){
                        return true
                    }
                else{
                    layer.remove();
                    return false;
                }



            }

            function cleanMarker(){
                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker){
                        if(layer.options.title != "point" && layer.options.title != "me"){
                            layer.remove();
                        }
                    }
                });
            }
            async function loadMarker() {
                if (map.getZoom() > maxZoom && place.id && search_polygon && toggleShow) {
                    cleanMarker();
                    const res = await axios.get('/api/markers-for-moder', {params: {search_polygon: search_polygon,ids:place.id.toString()}});
                    if(res.status == 200){
                       if(res.data.length){
                           dataTree = res.data;
                           renderLoadedMap();
                       }
                    }
                }
                else{
                    cleanMarker();
                }
            }

            function renderLoadedMap(){
                dataTree.forEach(item=>{
                    let marker = L.marker([item.point.coordinates[1],item.point.coordinates[0]],{title:"loaded"}).addTo(map);
                    marker.pm.setOptions({
                        allowEditing:false,
                        allowRemoval:false,
                        allowCutting:false,
                        allowRotation:false,
                    });
                });
            }
            $("#showLocated").on("click",function (){
                toggleShowAction();
            });

            function getSearchPolygon(event){
                if(map.getZoom() > maxZoom){
                    let bounds = event.target.getBounds();
                    search_polygon = new L.Polygon([
                        bounds._southWest,
                        L.latLng(bounds._northEast.lat, bounds._southWest.lng), // Top-left coordinate
                        bounds._northEast,
                        L.latLng(bounds._southWest.lat, bounds._northEast.lng)
                    ]);
                    search_polygon = JSON.stringify(search_polygon.toGeoJSON());
                    loadMarker();
                }
                else{
                    cleanMarker();
                }
            }

            function toggleShowAction(){
                toggleShow = !toggleShow;
                if(!toggleShow){
                    cleanMarker();
                }
                else{
                    loadMarker();
                }
            }

            $('form#createMarkerPointForm').submit(function(){
                $("#buttonSendMarker").prop('disabled', true);
            });

            L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}', {maxNativeZoom: 18,maxZoom:28}).addTo(map);

        </script>
    @endpush
</x-app-layout>
