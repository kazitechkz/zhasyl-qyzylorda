<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Удалить посадки места - {{$place->title_ru}}</h1>
        <div class="my-2">
            <hr>
            <label class="fs-6 my-2 text-dark font-weight-bold">Вид насаждения</label>
        </div>
        <form id="area-form" action="{{route("delete-markers-by-place-stats",["id"=>$place->id])}}"  method="post">
            @csrf
            @method('PUT')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="bg-danger text-white my-2 p-2">{{$error}}</div>
                @endforeach
            @endif
            <select id="breedSelection" name="breeds_id[]" class="w-100 mw-100" multiple>
                @foreach($breeds as $breedItem)
                    <option value="{{$breedItem->id}}">{{$breedItem->title_ru}} ({{$breedItem->type->title_ru}})</option>
                @endforeach
            </select>
            <hr>
            <select
                id="map_tile_change"
                class="form-select w-full mb-4">
                <option value="0" selected>Google Map</option>
                <option value="1">2Gis Map</option>
                <option value="2">MapBox Map</option>
            </select>
            <div class="relative mb-4">
                <div id='map'></div>
            </div>
            <input type="hidden" name="geocode" id="geocode">
            <br>
            <button
                id="submit-map"
                class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Удалить
            </button>
        </form>

    </div>

    @push('js')
        <x-leaflet-scripts></x-leaflet-scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
        <script>
            const selectIds = ["#breedSelection"];
            selectIds.forEach((idItem)=>{
                $(idItem).select2();
            });
            let place = {{Js::from($place)}};
            let search_polygon;
            let breed_ids;
            let dataTree = [];
            let confirm_delete = false;
            let maxZoom = 16;
                //    Initialize Map
                let map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
            if(place){

                map.pm.addControls({
                    position: 'topleft',
                    drawCircle: false,
                    drawCircleMarker:false,
                    tooltips:false,
                    drawPolyline:false,
                    dragMode:false,
                    cutPolygon:false,
                    drawPolygon:true,
                    drawRectangle:false,
                    editMode:true,
                    drawText:false,
                    removalMode:false,
                    drawMarker:false,
                    rotateMode:false
                });
                map.on("pm:create", ({shape, layer}) => {
                    layer.on("pm:edit", (e) => {
                        changeGeoCode(layer.toGeoJSON());
                    });
                    changeGeoCode(layer.toGeoJSON());
                    clearOtherPolygon(layer._leaflet_id,shape);

                });
                L.geoJSON(JSON.parse(place.geocode), {
                    style: {
                        color: place.bg_color
                    },
                    onEachFeature: function (feature, layer) {
                        layer.bindTooltip(place.title_ru, { permanent: true, offset: [0, 12] });
                            layer.pm.setOptions({
                                allowEditing:false,
                                allowRemoval:false,
                                allowCutting:false,
                                allowRotation:false,
                                isBase: true,
                                id:Date.now()
                            });

                            layer.on('pm:change', ({layer, latlngs, shape}) => {
                                checkInBounds(layer);
                            })
                    },

                }).addTo(map)
            }
            map.on("zoomend",function (event) {
                getSearchPolygon(event);
            })
            map.on("moveend",function (event) {
                getSearchPolygon(event);
            })

            $('#breedSelection').on('select2:select', function (e) {
               findBreed();
               loadMarker();
            });

           function findBreed(){
                breed_ids = "";
                $('#breedSelection').find(':selected').each(function(item)
                {
                    breed_ids += "" +$('#breedSelection').find(':selected')[item].value + ",";
                });
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

            function clearOtherPolygon(activeId,shape){
                if(shape == "Polygon"){
                    map.eachLayer((itemLayer)=>{
                        if(itemLayer instanceof L.Polygon){
                            if(itemLayer._drawnByGeoman && itemLayer._leaflet_id != activeId){
                                itemLayer.remove();
                            }
                        }
                    })
                }
            }
            async function loadMarker() {
                if (map.getZoom() > maxZoom && place.id && search_polygon) {
                    cleanMarker();
                    findBreed();
                    const res = await axios.get('/api/markers-all-place', {params: {search_polygon: search_polygon,ids:place.id.toString(),breed:breed_ids}});
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

            $("#submit-map").on("click",function (e) {
                e.preventDefault();
                $q = confirm('Вы хотите удалить выбранные насаждения?');
                if($q){
                    $("#area-form").submit();
                }
            })
            function changeGeoCode(dataPolygons){
                $("#geocode").attr("value",JSON.stringify(dataPolygons));
            }
            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            // L.tileLayer("http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map);
            let googleTile = L.tileLayer("http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:19}).addTo(map),
                gisTile = L.tileLayer("http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map),
                mapboxTile = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v12/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibnVyYmFraXQiLCJhIjoiY2s2bDMxNHV4MDl1bzNvcGFtbzN4aW9oaiJ9.UJwM6VtXrk62p_s54jGU5A', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:20}).addTo(map);
            $("#map_tile_change").on("change", function (e) {
                if ($("#map_tile_change").val() == 0) {
                    map.removeLayer(gisTile);
                    map.removeLayer(mapboxTile);
                    map.addLayer(googleTile);
                } else if($("#map_tile_change").val() == 1) {
                    map.removeLayer(googleTile);
                    map.removeLayer(mapboxTile);
                    map.addLayer(gisTile);
                } else {
                    map.removeLayer(googleTile);
                    map.removeLayer(gisTile);
                    map.addLayer(mapboxTile);
                }
            })
            map.addLayer(googleTile)
        </script>
    @endpush
</x-app-layout>
