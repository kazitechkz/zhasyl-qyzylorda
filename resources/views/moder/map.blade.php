<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
    @endpush
    <div class="container mx-auto py-5">

        @if(count($areas))
            <select
                id="area_id_change"
                class="d-none form-select w-full mb-4 @error('area_id') border-red-600 @enderror"
                name="area_id">
                <option value="0">Все</option>
            </select>
            @error('area_id')
                <div class="text-red-600 mb-2">{{ $message }}</div>
            @enderror
        @endif

        <div class="relative mb-4">
            <div id='map'></div>
        </div>

    </div>

    @push('js')
        <x-leaflet-scripts></x-leaflet-scripts>
        <script>
            //    Initialize Map
            var map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
                drawCircleMarker:false,
                tooltips:true,
                drawPolyline:false,
                drawRectangle: false,
                dragMode:false,
                cutPolygon:false,
                drawPolygon:false,
                editMode:false,
                drawMarker:false,
                rotateMode:false,
                removalMode: false
            });
            map.pm.setLang('ru');
            let allPlaces = @json($places),
                allAreas = @json($areas),
                activeAreaGeo,
                dataPolygons = [];

            //Initialize select form
            toggleActive( $("#area_id_change"));

            //On change select
            $("#area_id_change").on("change",function (e) {
                clearMap();
                toggleActive(this);
            })

            //Toggle active option
            function toggleActive(activeSelect){

                var areaOption = $(activeSelect).find('option:selected');
                var activeArea = areaOption.attr("data-area");
                if (activeArea === undefined) {
                    changeActiveArea2(allAreas, allPlaces)
                }
            }

            function changeActiveArea(area,isArea = false){
                if(area.place != null){
                    let toolTip = area.place.title_ru + "("+area.place.markers_count+")",
                        color = area.place.bg_color;

                    if (area.place.markers_count == 0) {
                        color = 'red';
                    }
                    L.geoJSON(JSON.parse(area.place.geocode), {
                        style: {
                            color: color
                        },
                        onEachFeature: function (feature, layer) {
                            if(isArea){
                                activeAreaGeo = layer;
                            }
                            layer.bindTooltip(toolTip, { permanent: true, offset: [0, 12] });
                            layer.pm.setOptions({
                                allowEditing:false,
                                allowRemoval:false,
                                allowCutting:false,
                                allowRotation:false,
                                isBase: true,
                                isArea:isArea,
                                id:Date.now()
                            });

                        },

                    }).addTo(map)
                }
            }

            function changeActiveArea2(area, places){
                if(area != null){
                    area.forEach(function (area) {
                        L.geoJSON(JSON.parse(area.geocode), {
                            style: {
                                color: area.bg_color
                            },
                            onEachFeature: function (feature, layer) {
                                layer.bindTooltip(area.title_ru, { permanent: true, offset: [0, 12] });
                            },
                        }).addTo(map)
                        if(places != null && places.length > 0) {
                            places.forEach(
                                placeItem => changeActiveArea(placeItem)
                            )
                            // places.forEach(function (res) {
                            //     console.log(res)
                            // })
                        }
                    })

                }
            }

            function clearMap(){
                map.eachLayer(function (layer) {
                    if(layer instanceof L.Polygon){
                        map.removeLayer(layer);
                    }
                });
            }

            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v12/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibnVyYmFraXQiLCJhIjoiY2s2bDMxNHV4MDl1bzNvcGFtbzN4aW9oaiJ9.UJwM6VtXrk62p_s54jGU5A', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map);

        </script>
    @endpush
</x-app-layout>
