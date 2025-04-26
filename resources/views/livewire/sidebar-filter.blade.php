<div>
    <div class="accordion" id="myCollapseMenu">
        <div class="accordion-item">
            <h2 class="accordion-header" id="treeheadingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#treeCollapse" aria-expanded="true" aria-controls="treeCollapse">
                    Выбранное насаждение
                </button>
            </h2>
            <div id="treeCollapse" aria-labelledby="treeheadingOne" data-bs-parent="#myCollapseMenu">
                <div class="accordion-body">
                    @if($activeMarker)
                        <div class="relative mb-1">
                            <label>Номер:</label>
                            <input
                                type="text"
                                disabled
                                class="peer block min-h-[auto] w-full rounded border-1"
                                value="{{$activeMarker->id}}" />
                        </div>
                        @if($activeMarker->place)
                            <div class="relative mb-1">
                                <label>Субрайон:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->place->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->type)
                            <div class="relative mb-1">
                                <label>Тип:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->type->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->breed)
                            <div class="relative mb-1">
                                <label>Тип насаждения:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->breed->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->sanitary)
                            <div class="relative mb-1">
                                <label>Тип санитарного состояния:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->sanitary->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->status)
                            <div class="relative mb-1">
                                <label>Тип состояния:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->status->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->category)
                            <div class="relative mb-1">
                                <label>Тип категории:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->category->title_ru}}" />
                            </div>
                        @endif
                        @if($activeMarker->event)
                            <div class="relative mb-1">
                                <label>Тип мероприятия:</label>
                                <input
                                    type="text"
                                    disabled
                                    class="peer block min-h-[auto] w-full rounded border-1"
                                    value="{{$activeMarker->event->title_ru}}" />
                            </div>
                        @endif
                        <div class="relative mb-1">
                            <label>Диаметр(см):</label>
                            <input
                                type="text"
                                disabled
                                class="peer block min-h-[auto] w-full rounded border-1"
                                value="{{$activeMarker->diameter}}" />
                        </div>
                        <div class="relative mb-1">
                            <label>Высота(м):</label>
                            <input
                                type="text"
                                disabled
                                class="peer block min-h-[auto] w-full rounded border-1"
                                value="{{$activeMarker->height}}" />
                        </div>
                        <div class="relative mb-1">
                            <label>Возраст (лет):</label>
                            <input
                                type="text"
                                disabled
                                class="peer block min-h-[auto] w-full rounded border-1"
                                value="{{$activeMarker->age}}" />
                        </div>
                        <div class="relative mb-2 d-flex justify-content-around">
                            <a href="{{route("change-marker",$activeMarker->id)}}" class="btn btn-warning text-white">Изменить</a>
                            <a wire:click="$emit('removeMarker',{{$activeMarker->id}})"   class="btn btn-danger text-white">Удалить</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="areaheadingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#areaCollapse" aria-expanded="true" aria-controls="areaCollapse">
                    Районы
                </button>
            </h2>
            <div id="areaCollapse" class=" show" aria-labelledby="areaheadingOne" data-bs-parent="#myCollapseMenu">
                <div class="accordion-body">
                    @foreach($areas as $areaItem)
                    <div class="form-check">
                        <input wire:click="$emit('areaChanged',{{$areaItem->id}})" class="form-check-input" type="checkbox" id="{{$areaItem->title_ru}}">
                        <label class="form-check-label" for="{{$areaItem->title_ru}}">
                            {{$areaItem->title_ru}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="placeheadingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#placeCollapse" aria-expanded="true" aria-controls="placeCollapse">
                    Места
                </button>
            </h2>
            <div id="placeCollapse" aria-labelledby="placeheadingOne" data-bs-parent="#myCollapseMenu">
                <div class="accordion-body">
                    @foreach($places as $placeItem)
                        <div class="form-check">
                            <input data-id="{{$placeItem->id}}" data-geo="{{$placeItem->geocode}}" data-color="{{$placeItem->bg_color}}" wire:click="$emit('placeChange',{{$placeItem->id}})" class="place-check form-check-input" type="checkbox" id="{{$placeItem->title_ru}}">
                            <label class="form-check-label" for="{{$placeItem->title_ru}}">
                                {{$placeItem->title_ru}}
                            </label>
                        </div>
                    @endforeach
                    <input id="selectedPlaces" hidden type="text" value="{{implode(",",$selectedPlaces)}}">
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="filterheadingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse">
                    Фильтры
                </button>
            </h2>
            <div id="filterCollapse" aria-labelledby="filterheadingOne" data-bs-parent="#myCollapseMenu" wire:ignore>
                <div class="accordion-body">
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Вид насаждения</label>
                        <select id="breedSelection" class="w-100 mw-100" multiple>
                            @foreach($breeds as $breedItem)
                                <option value="{{$breedItem->id}}">{{$breedItem->title_ru}}</option>
                            @endforeach
                        </select>
                        <hr>
                    </div>
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Состояние</label>
                        <select id="sanitarySelection" class="w-100 mw-100" multiple>
                            @foreach($sanitaries as $sanitaryItem)
                                <option value="{{$sanitaryItem->id}}">{{$sanitaryItem->title_ru}}</option>
                            @endforeach
                        </select>

                        <hr>
                    </div>
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Категория насаждений</label>
                        <select id="categoriesSelection" class="w-100 mw-100" multiple>
                            @foreach($categories as $categoryItem)
                                <option value="{{$categoryItem->id}}">{{$categoryItem->title_ru}}</option>
                            @endforeach
                        </select>

                        <hr>
                    </div>
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Тип посадки</label>
                        <select id="typeSelection" class="w-100 mw-100" multiple>
                            @foreach($types as $typeItem)
                                <option value="{{$typeItem->id}}">{{$typeItem->title_ru}}</option>
                            @endforeach
                        </select>
                        <hr>
                    </div>
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Вид мероприятия</label>
                        <select id="eventSelection" class="w-100 mw-100" multiple>
                            @foreach($events as $eventItem)
                                <option value="{{$eventItem->id}}">{{$eventItem->title_ru}}</option>
                            @endforeach
                        </select>
                        <hr>
                    </div>
                    <div class="my-2">
                        <hr>
                        <label class="fs-6 my-2 text-dark font-weight-bold">Статус</label>
                        <select id="statusSelection" class="w-100 mw-100" multiple>
                            @foreach($status as $statusItem)
                                <option value="{{$statusItem->id}}">{{$statusItem->title_ru}}</option>
                            @endforeach
                        </select>
                        <hr>
                    </div>
                    <div class="my-2 flex justify-content-end">
                        <button id="useFilter" class="btn btn-info">Поиск</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')

    <x-leaflet-scripts/>
    <script type="module">
        var map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14);
        map.pm.addControls({
            position: 'topleft',
            drawCircle: false,
            drawCircleMarker:false,
            tooltips:false,
            drawPolyline:false,
            dragMode:false,
            removalMode:false,
            cutPolygon:false,
            drawPolygon:false,
            drawText:false,
            drawRectangle:false,
            editMode:false,
            drawMarker:false,
            rotateMode:false
        });
        map.pm.setLang('ru');
        let maxZoomMap = 16;
        let activeMarkerId = 0;
       let areas = {{Js::from($this->areas)}};
       let dragMode = false;
       let places = [];
       let selectedAreas = [];
       let activeFilters = {"event":[],"status":[],"category":[],"sanitary":[],"breed":[]};
       let selectedPlaces = "";
       let currentZoom = map.getZoom();
       let search_polygon;
        let greenIcon = L.icon({
            iconUrl: '/images/leaf-green.png',
            shadowUrl: '/images/leaf-shadow.png',
            iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (el, component) => {
                selectedAreas = @this.selectedAreas;
                renderMap();
        })})

        function renderMap(){
            cleanMap();
            let renderedArea = areas.filter(areaItem=>
               selectedAreas.includes(areaItem.id)
            );
            renderedArea.forEach(function (area){
                let areaLayer = L.geoJSON(JSON.parse(area.geocode), {style: {color: area.bg_color}}).addTo(map);
                areaLayer.pm.enable({
                    draggable: false,
                });
            });
            let placesChecked =$('.place-check:checkbox:checked').each(function () {
                var geocode = $(this).attr("data-geo");
                var bg_color = $(this).attr("data-color");
                let placeLayer = L.geoJSON(JSON.parse(geocode), {style: {color:bg_color},draggable:false},).addTo(map);
                placeLayer.pm.enable({
                    draggable: false,
                });
                selectedPlaces = $("#selectedPlaces").val();
            });
            loadMarker();
        }

        function cleanMap(){
            map.eachLayer(function(layer) {
                if (!!layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });
        }

        function cleanMarker(){
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker){
                    layer.remove();
                }
            });
        }

        map.on("zoomend",function (event) {
            currentZoom = map.getZoom();
            loadMarker();
        })
        map.on("pm:globaldragmodetoggled", (e) => {
            dragMode = e.enabled;
        });

        map.on("moveend",function (event) {
            if(currentZoom > maxZoomMap){
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
        })


        async function loadMarker() {
            if (currentZoom > maxZoomMap && selectedPlaces && search_polygon && !dragMode) {
                let httpParams = {"search_polygon": search_polygon,"ids":selectedPlaces};
                let filtersTags = ["event","status","category","sanitary","breed"];
                cleanMarker();
                filtersTags.forEach((filter)=>{
                    if(activeFilters.hasOwnProperty(filter)){
                        if(activeFilters[filter].length){
                            httpParams[filter] = activeFilters[filter].join(', ');
                        }
                    }
                });
                const res = await axios.get('/api/markers-all-place', {params: httpParams});
               if(res.status == 200){
                    res.data.forEach(item=>{
                      let marker = L.marker([item.point.coordinates[1],item.point.coordinates[0]],).addTo(map);
                      marker.on("pm:dragend",function ({layer, shape}) {
                          Livewire.emit('changeMarkerGeo',item.id,JSON.stringify(layer.getLatLng()));
                          activeMarkerId = 0;
                          map.pm.addControls({ dragMode: false });
                          dragMode = false;
                          map.pm.disableGlobalDragMode();
                      });
                      marker.on("click",()=>{
                          if(item.id != activeMarkerId){
                              activeMarkerId = item.id;
                              Livewire.emit('loadMarker',item.id);
                              map.pm.addControls({ dragMode: true });
                          }

                      });
                    });
               }
            }
            else{
                cleanMarker();
            }
        }

        $("#useFilter").on("click",function () {
            try{
                activeFilters["event"] = $("#eventSelection").val();
                activeFilters["status"] = $("#statusSelection").val();
                activeFilters["category"] = $("#categoriesSelection").val();
                activeFilters["breed"] = $("#breedSelection").val();
                activeFilters["sanitary"] = $("#sanitarySelection").val();
                loadMarker();
            }
            catch (e) {
                console.log(e);
            }
        })

        L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}',{
            maxNativeZoom: 18,
            maxZoom: 24
        }).addTo(map);
    </script>
@endpush
