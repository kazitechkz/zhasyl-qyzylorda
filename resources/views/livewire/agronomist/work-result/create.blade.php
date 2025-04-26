@push('css')
    <x-leaflet-styles/>
    <style>
        #map {height: 300px}
        select {width: 100%}
        /*#geo_denied {display: none}*/
    </style>
@endpush
<div class="container">
    <div class="row">
        <div class="row my-2">
            <div class="col-12">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Начальник</th>
                                        <th scope="col" class="px-6 py-4">Наименование</th>
                                        <th scope="col" class="px-6 py-4">Описание</th>
                                        <th scope="col" class="px-6 py-4">Департамент</th>
                                        <th scope="col" class="px-6 py-4">Работник</th>
                                        <th scope="col" class="px-6 py-4">Дата начала</th>
                                        <th scope="col" class="px-6 py-4">Дата окончания</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{$work->id}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->chief->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->title}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{!! $work->description !!}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->department->title}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->user->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->start_at->format('H:i d.m.Y')}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$work->end_at->format('H:i d.m.Y')}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">

        </div>
    </div>
</div>
<form enctype="multipart/form-data" method="post" action="{{route("agronomist-work-result.store")}}">
    @csrf
    <input hidden name="work_id" value="{{$work->id}}">
    <div class="relative mb-4" wire:ignore>
        <label>Отчет</label>
        <textarea id="editor"  name="comment" rows="12" wire:model="comment" class="@error('comment') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1 ckeditor"></textarea>
        @error('comment')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative mb-4" data-te-input-wrapper-init>
        <select wire:model="status"  name="status" class="w-full">
            <option value="-1">Не выполнено</option>
            <option value="1">Выполнено</option>
        </select>
        @error('status')
        <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative mb-4">
        <label>Фото-отчеты (необязательно)</label>
        <input name="files[]" type="file" multiple>
    </div>
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
        let marker = {{Js::from($work)}};
        const map = L.map('map', {preferCanvas: true}).setView([42.315524, 69.586943], 14);
        map.setView([marker.point.coordinates[1],marker.point.coordinates[0]], 18);
        map.addLayer(new L.marker([marker.point.coordinates[1],marker.point.coordinates[0]]));
        L.tileLayer('http://tile2.maps.2gis.com/tiles?x={x}&y={y}&z={z}', {maxNativeZoom: 18,maxZoom:28}).addTo(map);

    </script>
@endpush
