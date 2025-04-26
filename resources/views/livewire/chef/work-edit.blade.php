@push('css')
    <x-leaflet-styles/>
    <style>
        #map {height: 300px}
        select {width: 100%}
        /*#geo_denied {display: none}*/
    </style>
@endpush
<form method="post" action="{{route("chef-work.update",$work->id)}}">
    @method('PUT')
    @csrf
    <div class="relative mb-4" data-te-input-wrapper-init>
        <select wire:model="department_id" wire:change="changeDepartment" name="department_id" class="w-full">
            <option value="">Выберите отдел</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->title}}</option>
            @endforeach
        </select>
        @error('department_id')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    @if($users)
        <div class="relative mb-4" data-te-input-wrapper-init>
            <select wire:model="user_id" name="user_id" class="w-full">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}} ({{$user->role->title_ru}})</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>
    @endif
    <div class="relative mb-4">
        <input
            type="text"
            class="@error('title') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
            wire:model="title"
            name="title"
            value="{{old('title')}}"
            placeholder="Наименование" />
        @error('title')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative mb-4" wire:ignore>
        <label>Описание</label>
        <textarea id="editor"  name="description" rows="12" wire:model="description" class="@error('description') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1 ckeditor">

        </textarea>
        @error('description')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative mb-4" wire:ignore>
        <input
            id="start_at"
            type="text"
            class="@error('start_at') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
            wire:model="start_at"
            name="start_at"
            value="{{old('start_at')}}"
            placeholder="Дата начала" />
        @error('start_at')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative mb-4" wire:ignore>
        <input
            id="end_at"
            type="text"
            class="@error('end_at') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
            wire:model="end_at"
            name="end_at"
            value="{{old('end_at')}}"
            placeholder="Дата Окончания" />
        @error('start_at')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <input hidden name="point" id="point" value="{{$work->point}}">
    <div wire:ignore id='map' class="position-relative"></div>
    <button
        type="submit"
        class="my-4 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
        Сохранить
    </button>
</form>

@push("js")
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <x-leaflet-scripts/>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        $('#start_at').flatpickr({
            dateFormat: "H:i d.m.Y",
            enableTime: true,
            time_24hr: true
        });
        $('#end_at').flatpickr({
            dateFormat: "H:i d.m.Y",
            enableTime: true,
            time_24hr: true
        });
        let marker = {{Js::from($work)}};
        const map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14);
        map.setView([marker.point.coordinates[1],marker.point.coordinates[0]], 18);
        map.addLayer(new L.marker([marker.point.coordinates[1],marker.point.coordinates[0]]));
        map.pm.addControls({
            position: 'topleft',
            drawCircle: false,
            drawCircleMarker:false,
            tooltips:false,
            drawPolyline:false,
            dragMode:false,
            cutPolygon:false,
            drawPolygon:false,
            drawRectangle:false,
            drawText:false,
            editMode:false,
            drawMarker:true,
            rotateMode:false
        });
        map.on('click', function(e) {
            // get the count of currently displayed markers
            var marker = L.marker(e.latlng, {title: "point"});
            map.eachLayer(function (mapItem){
                if(mapItem instanceof L.Marker){
                    mapItem.remove();
                }
            })
            marker.addTo(map);
            $('#point').attr('value',JSON.stringify(marker.toGeoJSON()));
        });

        L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}', {maxNativeZoom: 18,maxZoom:28}).addTo(map);

    </script>
@endpush
