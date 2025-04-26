
<div class="grid grid-cols-4 gap-4">
    <div class="relative mb-4" data-te-input-wrapper-init>
        <label>Выберите район</label>
        <select wire:change="getPlacesByAreaId" name="area_id" wire:model="areaId" class="w-full" data-te-select-init>
            <option value="0" selected>Все</option>
            @foreach($areas as $item)
                {{--                <option wire:click="getPlacesByAreaId({{$item->id}})" value="{{$item->id}}">{{$item->title_ru}}</option>--}}
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
    </div>

    @if($show)
        <div class="relative mb-4" data-te-input-wrapper-init>
            <label>Выберите место</label>
            <select name="place_id" class="w-full" data-te-select-init>
                <option value="0" selected>Все</option>
                @foreach($places as $item)
                    <option value="{{$item->id}}">{{$item->title_ru}}</option>
                @endforeach
            </select>
        </div>
    @endif

    {{--        <div class="relative mb-4" data-te-input-wrapper-init>--}}
    {{--            <label>Выберите категорию насаждений</label>--}}
    {{--            <select name="category_id" class="w-full" data-te-select-init>--}}
    {{--                <option value="0" selected>Все</option>--}}
    {{--                @foreach($categories as $item)--}}
    {{--                    <option value="{{$item->id}}">{{$item->title_ru}}</option>--}}
    {{--                @endforeach--}}
    {{--            </select>--}}
    {{--        </div>--}}

    <div class="relative mb-4" data-te-input-wrapper-init>
        <label>Выберите вид насаждения</label>
        <select name="type_id" class="w-full" data-te-select-init>
            <option value="0" selected>Все</option>
            @foreach($types as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
    </div>

    <div class="relative mb-4" data-te-input-wrapper-init>
        <label>Выберите породу</label>
        <select name="breed_id" class="w-full" data-te-select-init>
            <option value="0" selected>Все</option>
            @foreach($breeds as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
    </div>

    <div class="relative mb-4" data-te-input-wrapper-init>
        <label>Выберите состояние</label>
        <select name="sanitary_id" class="w-full" data-te-select-init>
            <option value="0" selected>Все</option>
            @foreach($sanitaries as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
    </div>

    {{--        <div class="relative mb-4" data-te-input-wrapper-init>--}}
    {{--            <label>Выберите статус</label>--}}
    {{--            <select name="status_id" class="w-full" data-te-select-init>--}}
    {{--                <option value="0" selected>Все</option>--}}
    {{--                @foreach($statuses as $item)--}}
    {{--                    <option value="{{$item->id}}">{{$item->title_ru}}</option>--}}
    {{--                @endforeach--}}
    {{--            </select>--}}
    {{--        </div>--}}
</div>

