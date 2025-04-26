@push('front_css')
    <x-leaflet-styles></x-leaflet-styles>
    <style>
        #map {min-height: 100vh}
        select {width: 100%}
        /*#geo_denied {display: none}*/
        .leaflet-touch .leaflet-control-attribution,
        .leaflet-touch .leaflet-control-layers,
        .leaflet-touch .leaflet-bar {
            display: none!important;
        }
    </style>
@endpush
<div class="row">
    <div class="col-12 my-2 py-2">
        <div class="row py-2 px-3">
            @if($areas)
                <div class="col-12 col-md-6 col-lg-3">
                    <select wire:model="area_id" wire:change="changeArea" class="form-select form-select-lg mb-3">
                        @if(!$area_id)
                            <option value="{{null}}">Выберите район</option>
                        @endif
                        @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->title_ru}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if($loading)
                    <div class="col-12 col-md-6 col-lg-3">
                        @if($loading)
                            <p>Идет загрузка.....</p>
                        @endif
                    </div>
            @endif
        </div>
    </div>


    <div class="col-12">
        <div class="relative mb-4" wire:ignore>
            <div id='map'></div>
        </div>
    </div>
</div>

@push('front_js')
    <x-leaflet-scripts></x-leaflet-scripts>
    <script src="{{asset('js/heatmap.js')}}"></script>
    <script>
        //    Initialize Map
        var map = L.map('map',{preferCanvas:true}).setView([42.315524, 69.586943], 12);
        let heat;
        //On change select
        let points = {{\Illuminate\Support\Js::from($point)}};
        function getHeatMap(points){
            if(points && points.length > 0){
                let coordinates = [];
                points.forEach(item=>coordinates.push([item.point.coordinates[1],item.point.coordinates[0],0.5]));
                heat = L.heatLayer(coordinates, {radius: 25}).addTo(map);
            }
            else{

            }

        }
        Livewire.on('setMarkers', points=>{
            getHeatMap(points)
        })
        //Toggle active option

        L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}', {subdomains:['mt0','mt1','mt2','mt3'], maxZoom:18}).addTo(map);

    </script>
@endpush
