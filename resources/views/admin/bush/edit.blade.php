<x-app-layout>
    @push('css')
        <x-leaflet-styles/>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Создать новое насаждение</h1>
        <form action="{{route("bush.update",$bush)}}" id="area-form" method="post">
            @method("PUT")
            @csrf
            <div class="relative mb-4">
                <label>Место</label><br>
                <select id="place_ids" name="place_id" class="form-select select_2_form py-6" >
                    <option value="">Не выбрано</option>
                    @if(count($places))
                        @foreach($places as $placeItem)
                            <option
                                data-area="{{$placeItem}}"
                                value="{{$placeItem->id}}"
                                {{ ( $bush->place_id == $placeItem->id) ? 'selected' : '' }}
                                >
                                {{$placeItem->title_ru}} ({{$placeItem->area->title_ru}})
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('place_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Вид насаждения</label><br>
                <select id="type_ids" name="type_id" class="form-select select_2_form py-6" >
                    <option value="">Не выбрано</option>
                    @if(count($types))
                        @foreach($types as $typeItem)
                            <option
                                {{ ( $bush->type_id == $typeItem->id) ? 'selected' : '' }}
                                value="{{$typeItem->id}}">
                                {{$typeItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('type_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Вид посадки</label><br>
                <select id="breed_ids" name="breed_id" class="form-select select_2_form py-6" >
                    <option value="">Не выбрано</option>
                    @if(count($breeds))
                        @foreach($breeds as $breedItem)
                            <option
                                {{ ( $bush->breed_id == $breedItem->id) ? 'selected' : '' }}
                                value="{{$breedItem->id}}">
                                {{$breedItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('breed_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Вид состояний</label><br>
                <select id="sanitary_ids" name="sanitary_id" class="form-select select_2_form py-6" >
                    <option value="">Не выбрано</option>
                    @if(count($sanitaries))
                        @foreach($sanitaries as $sanitaryItem)
                            <option
                                value="{{$sanitaryItem->id}}"
                                {{ ( $bush->sanitary_id == $sanitaryItem->id) ? 'selected' : '' }}
                            >
                                {{$sanitaryItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('sanitary_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="number"
                    min="0"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('length') border-red-600 @enderror"
                    name="length"
                    value="{{$bush->length}}"
                    placeholder="Длина в метрах" />
                @error('length')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="number"
                    min="0"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('height') border-red-600 @enderror"
                    name="height"
                    value="{{$bush->height}}"
                    placeholder="Высота в метрах" />
                @error('height')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="number"
                    min="0"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('width') border-red-600 @enderror"
                    name="width"
                    value="{{$bush->width}}"
                    placeholder="Ширина в метрах" />
                @error('width')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @error('geocode')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <div class="relative mb-4">
                <div id='map'></div>
            </div>
            <input type="hidden" name="geocode" id="geo">
            <button
                id="submit-map"
                type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Сохранить
            </button>
        </form>

    </div>

    @push('js')
        <x-leaflet-scripts/>

        <script>

            //    Initialize Map
            var dataLines = [];

            var map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
                drawCircleMarker:false,
                tooltips:true,
                drawPolyline:true,
                dragMode:false,
                cutPolygon:false,
                drawPolygon:false,
                drawRectangle:false,
                editMode:true,
                drawMarker:false,
                rotateMode:false
            });

            try {
                $bush = {{Js::from($bush)}};
                $("select").select2();
                $("#place_ids").val($bush.place_id);
                $("#place_ids").trigger("change");
                toggleActive($("#place_ids"));
                changeActiveArea($bush.place);
                selectActiveBush($bush);
                $("#type_ids").val($bush.type_id);
                $("#type_ids").trigger("change");
                $("#sanitaries_ids").val($bush.sanitary_id);
                $("#sanitaries_ids").trigger("change");
                $("#breed_ids").val($bush.breed_id);
                $("#breed_ids").trigger("change");
            }
            catch (e) {
                console.log(e);
            }

            map.pm.setLang('ru');
            //OnCreated
            map.on('pm:create', ({ shape,layer }) => {

            });

            //On Change Place Select
            $("#place_ids").on("change",function (e) {
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
                }
                if(activeArea.bushes){
                    activeArea.bushes.forEach(
                        (bushItem) => changeActiveArea(bushItem,false)
                    )
                }
            }
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
                            layer.pm.setOptions({
                                allowEditing:false,
                                allowRemoval:false,
                                allowCutting:false,
                                allowRotation:false,
                                isBase: true,
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

            function selectActiveBush(bush){
                L.geoJSON(JSON.parse(bush.geocode)).addTo(map)
            }

            //Action when save it
            $("#submit-map").on("click",function (e) {
                e.preventDefault();
                let dataPolygons = [];
                map.eachLayer(function(itemLayer){
                    if(itemLayer instanceof L.Polyline ){
                        if(!itemLayer.pm.getOptions().isBase){
                            const polygon = itemLayer.toGeoJSON();
                            dataPolygons.push(polygon)
                            $("#geo").attr("value",JSON.stringify(dataPolygons));
                        }
                    }
                });
                $("#area-form").submit();
            })
            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        </script>
    @endpush
</x-app-layout>
