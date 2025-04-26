<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Изменить посадку № {{$marker->id}}</h1>
        <form id="area-form" action="{{route("update-marker",$marker->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="relative mb-4">
                <label>Вид насаждения</label>
                <select class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($types))
                        @foreach($types as $typeItem)
                            <option @if($typeItem->id == $marker->type_id) selected @endif value="{{$typeItem->id}}">
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
                <label>Хозяйственное мероприятия</label>
                <select name="event_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($events))
                        @foreach($events as $eventItem)
                            <option @if($eventItem->id == $marker->event_id) selected @endif value="{{$eventItem->id}}">
                                {{$eventItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('event_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Состояние посадки</label>
                <select name="sanitary_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($sanitaries))
                        @foreach($sanitaries as $sanitaryItem)
                            <option @if($sanitaryItem->id == $marker->sanitary_id) selected @endif value="{{$sanitaryItem->id}}">
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
                <label>Категория посадки</label>
                <select name="category_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($categories))
                        @foreach($categories as $categoryItem)
                            <option @if($categoryItem->id == $marker->category_id) selected @endif value="{{$categoryItem->id}}">
                                {{$categoryItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Тип насаждения</label>
                <select name="breed_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($breeds))
                        @foreach($breeds as $breedItem)
                            <option @if($breedItem->id == $marker->breed_id) selected @endif value="{{$breedItem->id}}">
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
                <label>Статус посадки</label>
                <select name="status_id" class="form-select select_2_form">
                    <option value="">Не выбрано</option>
                    @if(count($status))
                        @foreach($status as $statusItem)
                            <option @if($statusItem->id == $marker->status_id) selected @endif value="{{$statusItem->id}}">
                                {{$statusItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('status_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label>Высота в метрах</label>
                <input value="{{$marker->height}}" id="height" name="height" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full @error('height') border-red-600 @enderror" placeholder="Введите высоту">
                @error('height')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label>Диаметр в см</label>
                <input  value="{{$marker->diameter}}" id="diameter" name="diameter" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full @error('diameter') border-red-600 @enderror" placeholder="Введите диаметер">
                @error('diameter')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label>Возраст в годах</label>
                <input value="{{$marker->age}}" id="age" name="age" min="0" max="150" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full" placeholder="Введите возраст дерева">
            </div>
            @error('geocode')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <div class="relative mb-4">
                <div id='map'></div>
            </div>
            <input type="hidden" name="geocode" id="geocode">
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
            <script>

            let marker = {{Js::from($marker)}},
                geocode = document.getElementById('geocode'),
                greenIcon = L.icon({
                iconUrl: '/images/leaf-green.png',
                shadowUrl: '/images/leaf-shadow.png',
                iconSize:     [38, 95], // size of the icon
                shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            }),
            //    Initialize Map
            map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
            if(marker){
                // L.marker([marker.point.coordinates[1],marker.point.coordinates[0]],{icon:greenIcon}).addTo(map);
                map.setView([marker.point.coordinates[1],marker.point.coordinates[0]], 18);

                let drawnItems = new L.FeatureGroup();
                drawnItems.addLayer(new L.marker([marker.point.coordinates[1],marker.point.coordinates[0]],{icon:greenIcon}));
                map.addLayer(drawnItems);
                let drawControl = new L.Control.Draw({
                    draw: {
                        polygon: false,
                        rectangle: false,
                        marker: false,
                        polyline: false,
                        circle: false
                    },
                    edit: {
                        featureGroup: drawnItems,
                        remove: false
                    }
                });
                map.addControl(drawControl);
                map.on('draw:edited', function (e) {

                    let layers = e.layers;
                    layers.eachLayer(function (layer) {
                        geocode.value = JSON.stringify({
                            "lat": layer.toGeoJSON().geometry.coordinates[1],
                            "lng": layer.toGeoJSON().geometry.coordinates[0]
                        });
                    });

                    // var layer = e.layer,
                    //     feature = layer.feature = layer.feature || {};
                    //
                    // feature.type = feature.type || 'Feature';
                    // var props = feature.properties = feature.properties || {};
                    //
                    // drawnItems.addLayer(layer);
                })
            }
            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        </script>
    @endpush
</x-app-layout>
