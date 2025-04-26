<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Изменить посадку № {{$report->marker_id}}</h1>
        <form id="area-form" action="{{route("reports.update",$report->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="relative mb-4">
                <a class="text-danger font-weight-bold" href="{{route("change-marker",[$report->marker_id])}}" target="_blank">Изменить маркер</a>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('marker_id') border-red-600 @enderror"
                    disabled
                    value="{{$report->marker_id}}" />
                @error('message')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative mb-4">
                <label>ФИО Заявителя</label>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('name') border-red-600 @enderror"
                    disabled
                    value="{{$report->name}}" />
                @error('message')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Телефон Заявителя</label>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('phone') border-red-600 @enderror"
                    disabled
                    value="{{$report->phone}}" />
                @error('message')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Email Заявителя</label>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('email') border-red-600 @enderror"
                    disabled
                    value="{{$report->email}}" />
                @error('message')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Сообщение Заявителя</label>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('message') border-red-600 @enderror"
                    disabled
                    value="{{$report->message}}" />
                @error('message')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative mb-4">
                <label>Ваш ответ (опционален)</label>
                <input
                    type="text"
                    class="peer block min-h-[auto] w-full rounded border-1 @error('answer') border-red-600 @enderror"
                    name="answer"
                    placeholder="Ответ" />
                @error('answer')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label>Ваш ответ (опционален)</label>
                <select
                    class="form-select w-full mb-4 @error('status') border-red-600 @enderror"
                    name="status">
                    <option value="0" @if($report->status == 0) selected @endif>Не отвечен</option>
                    <option value="1" @if($report->status == 1) selected @endif>Отвечен</option>

                </select>
            </div>
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
        <script>

            let marker = {{Js::from($report->marker)}},
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

            }
            // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        </script>
    @endpush
</x-app-layout>
