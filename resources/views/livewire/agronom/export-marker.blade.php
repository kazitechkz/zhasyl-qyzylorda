<div>
    <form wire:submit.prevent="export">
        @csrf
        @if(count($forExp) > 0)
            <input type="hidden" name="area_id" value="{{$forExp['area_id']}}">
            {{--            <input type="hidden" name="category_id" value="{{$forExp['category_id']}}">--}}
            @if(isset($forExp['place_id']))
                <input type="hidden" name="type_id" value="{{$forExp['place_id']}}">
            @endif
            <input type="hidden" name="type_id" value="{{$forExp['type_id']}}">
            <input type="hidden" name="breed_id" value="{{$forExp['breed_id']}}">
            <input type="hidden" name="sanitary_id" value="{{$forExp['sanitary_id']}}">
            {{--            <input type="hidden" name="status_id" value="{{$forExp['status_id']}}">--}}
        @endif
        <button type="submit" class="btn btn-success text-black text-hover-light">
            Экспорт в Excel
        </button>
        <div wire:loading>
            <img src="{{asset('images/loading.gif')}}" width="30" height="30">
        </div>

    </form>
    {{--    @if($exporting && !$exportFinished)--}}
    {{--        <div class="" wire:poll="updateExportProgress">--}}
    {{--            Файл экспортируется... подождите пожалуйста.--}}
    {{--        </div>--}}
    {{--    @endif--}}

    {{--    @if($exportFinished)--}}
    {{--        <div>Завершен. <a class="link-info cursor-pointer" wire:click="downloadExport">Скачать файл</a></div>--}}
    {{--    @endif--}}
</div>
