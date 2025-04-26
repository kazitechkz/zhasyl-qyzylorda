<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Изменить место {{$place->title_ru}}</h1>
        <form id="area-form" action="{{route('place.update',$place->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="relative mb-4">
                <input
                    type="text"
                    disabled
                    class="peer block min-h-[auto] w-full rounded border-1"
                    value="{{$area->title_ru}}"
                />
            </div>
            @if(count($cats))
                <select
                    id="area_id_change"
                    class="form-select w-full mb-4 @error('category_id') border-red-600 @enderror"
                    name="category_id">
                    @foreach($cats as $cat)
                        <option {{($place->category_id != null ? ($place->category_id == $cat->id ? "selected" : "") : "")}} value="{{$cat->id}}">
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
                    placeholder="Наименование на каз"
                    value="{{$place->title_kz}}"
                />
                @error('title_kz')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('title_ru') border-red-600 @enderror"
                    name="title_ru"
                    placeholder="Наименование на рус"
                    value="{{$place->title_ru}}"
                />
                @error('title_ru')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="geocode" id="geo" value="{{$place->geocode}}">

            <div class="relative mb-4">
                <label for="bg_color">Выберите цвет</label>
                <input type="color"
                       id="bg_color"
                       class="peer block min-h-[auto] w-full rounded border-1 @error('bg_color') border-red-600 @enderror"
                       name="bg_color"
                        value="{{$place->bg_color}}"
                >
                @error('bg_color')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @error('geocode')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <div class="relative mb-4">
                <div id='map'></div>
            </div>

            <button
                id="submit-map"
                type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Обновить
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
            let map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
                drawCircleMarker:false,
                tooltips:false,
                drawPolyline:false,
                drawRectangle: false,
                dragMode:false,
                cutPolygon:false,
                drawPolygon:false,
                editMode:true,
                drawMarker:false,
                rotateMode:false
            });
            map.pm.setLang('ru');

            let activeAreaGeo = {{Js::from($area)}};
            let activePlace = {{Js::from($place)}};
            let places = {{Js::from($places)}};
            let dataPolygons = []


            initialize_map();

            function initialize_map() {
                if(activeAreaGeo){
                    changeActiveArea(activeAreaGeo,true)
                }
                if(places.length > 0){
                    places.forEach(
                        placeItem => changeActiveArea(placeItem)
                    )
                }
                if(activePlace){
                    changeActiveArea(activePlace,false,false);
                }
            }


            function changeActiveArea(area,isArea = false,isBase = true){
                if(area != null){
                    L.geoJSON(JSON.parse(area.geocode), {
                        style: {
                            color: area.bg_color
                        },
                        onEachFeature: function (feature, layer) {
                            if(isArea){
                                activeAreaGeo = layer;
                            }

                            if (area.id == activePlace.id) {
                                layer.bindTooltip(activePlace.title_ru, { permanent: true, offset: [0, 12] });
                            } else if (!area.area_id) {
                                layer.unbindTooltip();
                            } else {
                                map.on('zoom', function() {
                                    console.log(map.getZoom())
                                    if (map.getZoom() >= 17) {
                                        layer.bindTooltip(area.title_ru , { permanent: true, offset: [0, 12]});
                                    } else {
                                        layer.unbindTooltip();
                                    }
                                });
                            }

                            if(isBase){
                                layer.pm.setOptions({
                                    allowEditing:false,
                                    allowRemoval:false,
                                    allowCutting:false,
                                    allowRotation:false,
                                    isBase: true,
                                    isArea:isArea,
                                    id:Date.now()
                                });
                            }
                            else{
                                layer.on('pm:change', ({layer, latlngs, shape}) => {
                                    checkInBounds(layer);
                                })
                            }

                        },

                    }).addTo(map)
                }
            }

            //OnCreated
            // map.on('pm:create', ({ shape,layer }) => {
            //     if(shape == "Polygon"){
            //         layer.pm.setOptions({
            //             allowSelfIntersection:false,
            //             id:Date.now()
            //         });
            //         layer.setStyle({color:`${$("#bg_color").val()}`})
            //         checkInBounds(layer);
            //         layer.on('pm:change', ({layer, latlngs, shape}) => {
            //             checkInBounds(layer);
            //         })
            //     }
            // });

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

            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        </script>
    @endpush
</x-app-layout>

