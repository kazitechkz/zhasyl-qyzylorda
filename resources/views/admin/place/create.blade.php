<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Создать новое место</h1>
        <form id="area-form" action="{{route('place.store')}}" method="post">
            @csrf
            @if(count($areas))
                <select
                    id="area_id_change"
                    class="form-select w-full mb-4 @error('area_id') border-red-600 @enderror"
                    name="area_id">
                    <option value="">Не выбрано</option>
                    @foreach($areas as $areaItem)
                        <option {{($area != null ? ($area->id == $areaItem->id ? "selected" : "") : "")}} data-area="{{$areaItem}}" value="{{$areaItem->id}}">
                            {{$areaItem->title_ru}}
                        </option>
                    @endforeach
                </select>
                @error('area_id')
                <div class="text-red-600 mb-2">{{ $message }}</div>
                @enderror
            @endif
            @if(count($cats))
                <label for="">Выберите категорию</label>
                <select
                    id="area_id_change"
                    class="form-select w-full mb-4 @error('category_id') border-red-600 @enderror"
                    name="category_id">
                    @foreach($cats as $cat)
                        <option data-area="{{$cat}}" value="{{$cat->id}}">
                            {{$cat->title_ru}}
                        </option>
                    @endforeach
                </select>
                @error('area_id')
                <div class="text-red-600 mb-2">{{ $message }}</div>
                @enderror
            @endif
            <div class="relative mb-4">
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('title_kz') border-red-600 @enderror"
                    name="title_kz"
                    placeholder="Наименование на каз" />
                @error('title_kz')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('title_ru') border-red-600 @enderror"
                    name="title_ru"
                    placeholder="Наименование на рус" />
                @error('title_ru')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="geocode" id="geo">

            <div class="relative mb-4">
                <label for="bg_color">Выберите цвет</label>
                <input type="color"
                       id="bg_color"
                       class="peer block min-h-[auto] w-full rounded border-1 @error('bg_color') border-red-600 @enderror"
                       name="bg_color">
                @error('bg_color')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @error('geocode')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

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

            <button
                id="submit-map"
                type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Сохранить
            </button>
        </form>

    </div>

    @push('js')
            <x-leaflet-scripts></x-leaflet-scripts>
            <script>
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                        cancelButton: 'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-90'
                    },
                    buttonsStyling: false
                })
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
                        drawPolygon:true,
                        editMode:true,
                        drawMarker:false,
                        rotateMode:false
                    });
                    map.pm.setLang('ru');

                    let activeAreaGeo;
                    let dataPolygons = []


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
                        if(activeArea != null){
                            activeArea = JSON.parse(activeArea);
                            changeActiveArea(activeArea,true)
                            if(activeArea.places != null && activeArea.places.length > 0){
                                activeArea.places.forEach(
                                    placeItem => changeActiveArea(placeItem)
                                )
                            }
                        }
                    }


                    //Event when color changes
                    $("#bg_color").on("change",function (e){
                        map.eachLayer(function(itemLayer){
                            if(itemLayer instanceof L.Polygon ){
                                if(!itemLayer.pm.getOptions().isBase){
                                    itemLayer.setStyle({color :`${$("#bg_color").val()}`})
                                }
                            }
                        });
                    });

                    function changeActiveArea(area,isArea = false){
                        if(area != null){
                            L.geoJSON(JSON.parse(area.geocode), {
                                style: {
                                    color: area.bg_color
                                },
                                onEachFeature: function (feature, layer) {
                                    if(isArea){
                                        activeAreaGeo = layer;
                                    }
                                    layer.bindTooltip(area.title_ru, { permanent: true, offset: [0, 12] });
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

                    function clearMap(){
                        map.eachLayer(function (layer) {
                            if(layer instanceof L.Polygon){
                                map.removeLayer(layer);
                            }
                        });
                    }

                    //OnCreated
                    map.on('pm:create', ({ shape,layer }) => {
                        if(shape == "Polygon"){
                            layer.pm.setOptions({
                                allowSelfIntersection:false,
                                id:Date.now()
                            });
                            layer.setStyle({color:`${$("#bg_color").val()}`})
                            checkInBounds(layer);
                            layer.on('pm:change', ({layer, latlngs, shape}) => {
                                checkInBounds(layer);
                            })
                        }
                    });


                    //Check if in selectedArea
                    function checkInBounds(layer){
                        if(activeAreaGeo){
                            if(turf.booleanContains(activeAreaGeo.toGeoJSON(),layer.toGeoJSON())){
                                return true;
                            }
                        }
                        swalWithBootstrapButtons.fire({
                            title: 'Вы уверены?',
                            text: "Объекты на карте выходят за рамки",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Я все равно хочу отрисовать их!',
                            cancelButtonText: 'Нет, удалить!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                swalWithBootstrapButtons.fire(
                                    'Новый объект создан!',
                                    'Вы успешно создали новый объект',
                                    'success'
                                )
                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                layer.remove();
                                swalWithBootstrapButtons.fire(
                                    'Объект удален',
                                    'Объект был удален с карты :)',
                                    'error'
                                )
                            }
                        })
                    }
                    //Action when save it
                    $("#submit-map").on("click",function (e) {
                        e.preventDefault();
                        map.eachLayer(function(itemLayer){
                            if(itemLayer instanceof L.Polygon ){
                                if(!itemLayer.pm.getOptions().isBase){
                                    const polygon = itemLayer.toGeoJSON();
                                    dataPolygons.push(polygon)
                                    $("#geo").attr("value",JSON.stringify(dataPolygons));
                                }
                            }
                        });
                        $("#area-form").submit();
                    })

                    let googleTile = L.tileLayer("http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map),
                        gisTile = L.tileLayer("http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map),
                        mapboxTile = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v12/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibnVyYmFraXQiLCJhIjoiY2s2bDMxNHV4MDl1bzNvcGFtbzN4aW9oaiJ9.UJwM6VtXrk62p_s54jGU5A', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
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
                    // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
                    // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v12/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibnVyYmFraXQiLCJhIjoiY2s2bDMxNHV4MDl1bzNvcGFtbzN4aW9oaiJ9.UJwM6VtXrk62p_s54jGU5A', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
                    // L.tileLayer("http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}", {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map);
                // L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
                //     maxZoom: 20,
                //     subdomains:['mt0','mt1','mt2','mt3']
                // }).addTo(map);

            </script>
    @endpush
</x-app-layout>
