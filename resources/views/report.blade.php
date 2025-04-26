@extends("layouts.front.front-layout")
@push('front_css')
    <x-leaflet-styles></x-leaflet-styles>
@endpush
@section("main")
    <!-- Quote Start -->
    <div class="container-fluid quote py-5" data-parallax="scroll" data-image-src="/images/bg-6.jpg">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7 my-2">
                    <form action="{{route("save-report")}}" method="post">
                        @csrf
                    <div class="bg-white rounded p-4 p-sm-5 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-5 text-center mb-5">Сообщить о проблеме</h1>
                        <input type="hidden" value="{{$marker->id}}" name="marker_id">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" name="name" id="gname" placeholder="ФИО" required>
                                    <label for="gname">Ваше Имя *</label>
                                </div>
                                @error('name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-light border-0" id="gmail" name="email" placeholder="Email" required>
                                    <label for="gmail">Email</label>
                                </div>
                                @error('email')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input name="phone" type="text" class="form-control bg-light border-0 w-full" id="cname" placeholder="Телефон">
                                    <label for="cname">Ваш Телефон *</label>
                                </div>
                                @error('phone')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" required class="form-control bg-light border-0" placeholder="Ваш текст" id="message" style="height: 100px"></textarea>
                                    <label for="message">Текст письма</label>
                                </div>
                                @error('message')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary py-3 px-4" type="submit">Отправить</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-5 my-2 max-h-full">
                    <div id='map'></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->
@endsection
@push('front_js')
    <x-leaflet-scripts></x-leaflet-scripts>
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

        }
        // L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VwbGF5a3oyMDIwIiwiYSI6ImNrcTRxd3I3czB2eHgydm8wOHR2NW40OTEifQ.a08RNc7xB3Tm1pGai2NNCQ', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:25}).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    </script>
@endpush

