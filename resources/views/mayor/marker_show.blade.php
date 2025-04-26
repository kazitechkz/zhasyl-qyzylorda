<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800"> Посадка № {{$marker->id}}</h1>

            <div class="relative mb-4">
                <label>Вид насаждения</label>
                <select disabled class="form-select select_2_form" >
                    @if($marker->breed)
                        <option value="">{{$marker->breed->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif
                </select>

            </div>
            <div class="relative mb-4">
                <label>Хозяйственное мероприятия</label>
                <select name="event_id" disabled class="form-select select_2_form" >
                    @if($marker->event)
                        <option value="">{{$marker->event->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif
                </select>

            </div>
            <div class="relative mb-4">
                <label>Состояние посадки</label>
                <select disabled name="sanitary_id" class="form-select select_2_form" >
                    @if($marker->sanitary)
                        <option value="">{{$marker->sanitary->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif

                </select>

            </div>
            <div class="relative mb-4">
                <label>Категория посадки</label>
                <select disabled name="category_id" class="form-select select_2_form" >
                    @if($marker->category)
                        <option value="">{{$marker->category->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif

                </select>

            </div>
            <div class="relative mb-4">
                <label>Тип насаждения</label>
                <select disabled name="breed_id" class="form-select select_2_form" >
                    @if($marker->type)
                        <option value="">{{$marker->type->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif

                </select>

            </div>
            <div class="relative mb-4">
                <label>Статус посадки</label>
                <select disabled name="status_id" class="form-select select_2_form">
                    @if($marker->status)
                        <option value="">{{$marker->status->title_ru}}</option>
                    @else
                        <option value="">Не выбрано</option>
                    @endif

                </select>

            </div>
            <div class="mb-2">
                <label>Высота в метрах</label>
                <input disabled value="{{$marker->height}}" id="height" name="height" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full @error('height') border-red-600 @enderror" placeholder="Введите высоту">

            </div>
            <div class="mb-2">
                <label>Диаметр в см</label>
                <input disabled  value="{{$marker->diameter}}" id="diameter" name="diameter" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full @error('diameter') border-red-600 @enderror" placeholder="Введите диаметер">

            </div>
            <div class="mb-2">
                <label>Возраст в годах</label>
                <input disabled value="{{$marker->age}}" id="age" name="age" min="0" max="150" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full" placeholder="Введите возраст дерева">
            </div>

            <div class="relative mb-4">
                <div id='map'></div>
            </div>
            <input type="hidden" name="geocode" id="geocode">

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
            if(marker) {
                let drawnItems = new L.FeatureGroup();
                drawnItems.addLayer(new L.marker([marker.point.coordinates[1],marker.point.coordinates[0]]));
                map.addLayer(drawnItems);
                map.setView([marker.point.coordinates[1], marker.point.coordinates[0]], 18);
            }
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        </script>
    @endpush
</x-app-layout>
