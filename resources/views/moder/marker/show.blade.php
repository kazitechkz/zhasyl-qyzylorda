<x-app-layout>
    @push('css')
        <x-leaflet-styles/>
        <style>
            #map {
                height: 300px;

            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Точка
        </h2>
    </x-slot>

    <div class="container mx-auto py-3 w-1/2">
        <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div id="map"></div>
            <div class="p-6">
                <h5
                    class="mb-2 text-xl font-medium leading-tight text-neutral-800">
                    Общая информация
                </h5>
{{--                <p class="mb-4 text-base text-neutral-600">--}}
{{--                    <b>Вид насаждений:</b> {{$tree->type->title_ru}}--}}
{{--                </p>--}}
                <p class="mb-4 text-base text-neutral-600">
                    <b>Порода дерева:</b> {{$tree->breed->title_ru}}
                </p>
{{--                <p class="mb-4 text-base text-neutral-600">--}}
{{--                    <b>Категория насаждений:</b> {{$tree->category->title_ru}}--}}
{{--                </p>--}}
                @if($tree->age)
                    <p class="mb-4 text-base text-neutral-600">
                        <b>Возраст:</b> {{$tree->age}}
                    </p>
                @endif
                <p class="mb-4 text-base text-neutral-600">
                    <b>Высота:</b> {{$tree->height}}
                </p>
                <p class="mb-4 text-base text-neutral-600">
                    <b>Диаметр:</b> {{$tree->diameter}}
                </p>
                <p class="mb-4 text-base text-neutral-600">
                    <b>Состояние:</b> {{$tree->sanitary->title_ru}}
                </p>
                @if($tree->status)
                    <p class="mb-4 text-base text-neutral-600">
                        <b>Статус:</b> {{$tree->status->title_ru}}
                    </p>
                @endif
{{--                <p class="mb-4 text-base text-neutral-600">--}}
{{--                    <b>Хозяйственное мероприятие:</b> {{$tree->event->title_ru}}--}}
{{--                </p>--}}
                @if($tree->landing_date)
                    <p class="mb-4 text-base text-neutral-600">
                        <b>Дата посадки:</b> {{$tree->landing_date}}
                    </p>
                @endif

            </div>
        </div>

        <div class="my-3">
            <a href="{{route('trees.index')}}"
                class="inline-block rounded bg-info px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Назад
            </a>
        </div>
    </div>

    @push('js')
            <x-leaflet-scripts/>

            <script>
                //    Initialize Map
                const
                    place = {{Js::from($tree->place)}},
                    area = {{Js::from($tree->place->area)}},
                    marker = {{Js::from($tree->geocode)}},
                    map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14),
                    cable = L.geoJSON(JSON.parse(place.geocode), {
                        style: {
                            color: place.bg_color
                        }
                    }).addTo(map),
                    greenIcon = L.icon({
                        iconUrl: '/images/leaf-green.png',
                        shadowUrl: '/images/leaf-shadow.png',
                        iconSize:     [38, 95], // size of the icon
                        shadowSize:   [50, 64], // size of the shadow
                        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62],  // the same for the shadow
                        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                    });

                map.fitBounds(cable.getBounds())

                // a layer group, used here like a container for markers
                var markersGroup = L.layerGroup();
                map.addLayer(markersGroup);

                L.marker(JSON.parse(marker), {icon: greenIcon}).addTo(map)

                // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 25}).addTo(map);

            </script>
    @endpush
</x-app-layout>

