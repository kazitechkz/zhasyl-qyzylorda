

<div>
    {{--<div class="mb-2">
        <select wire:model="category_id" name="category_id">
            <option value="">Выберите категорию *</option>
            @foreach($categories as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>--}}
{{--    <div class="mb-2">--}}
{{--        <select wire:model="type_id" name="type_id">--}}
{{--            <option value="">Выберите вид насаждения *</option>--}}
{{--            @foreach($types as $item)--}}
{{--                <option value="{{$item->id}}">{{$item->title_ru}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        @error('type_id')--}}
{{--            <div class="text-red-600">{{ $message }}</div>--}}
{{--        @enderror--}}
{{--    </div>--}}
    {{--<div class="mb-2">
        <select wire:model="event_id" name="event_id">
            <option value="">Выберите хозяйственное мероприятие *</option>
            @foreach($events as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
        @error('event_id')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>--}}
    <div class="mb-2">
        <select wire:model="sanitary_id" name="sanitary_id">
            <option value="">Выберите состояние *</option>
            @foreach($sanitaries as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
        @error('sanitary_id')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2"
{{--         x-data='{--}}
{{--        breedSelected(e) {--}}
{{--            let value = e.target.value--}}
{{--            let id = document.body.querySelector("datalist [value=\""+value+"\"]").dataset.value--}}
{{--            document.body.querySelector("#breed_id").value = id;--}}
{{--            console.log(id);--}}
{{--        }}'--}}
    >
{{--        <div class="flex">--}}
{{--            <input--}}
{{--                style="text-transform: capitalize;"--}}
{{--                type="text"--}}
{{--                list="breedOptions"--}}
{{--                wire:model="breedStr"--}}
{{--                class="fancy-tailwind-things w-full"--}}
{{--                placeholder="Введите породу"--}}
{{--                x-on:change="breedSelected($event)"--}}
{{--            >--}}
{{--            @if($showBtn)--}}
{{--                <button type="button" wire:click="addBreed()" class="btn btn-success bg-success">+</button>--}}
{{--            @endif--}}

{{--        </div>--}}

{{--        @if($showBtn)--}}
{{--            <input type="hidden" name="breed_id" id="breed_id" value="{{$this->breed_id}}">--}}
{{--        @endif--}}

{{--        <datalist id="breedOptions">--}}
{{--            @foreach($searchResults as $result)--}}
{{--                <option--}}
{{--                    wire:key="{{ $result['id'] }}"--}}
{{--                    data-value="{{ $result['id'] }}"--}}
{{--                    value="{{ $result['title_ru'] }}"--}}
{{--                ></option>--}}
{{--            @endforeach--}}
{{--        </datalist>--}}
        <div class="flex">
            <input type="text" wire:model="search" placeholder="Введите породу" class="w-full">
{{--            @if($showBtn)--}}
{{--                <button type="button" wire:click="addBreed()" class="btn btn-success bg-success">+</button>--}}
{{--            @endif--}}
        </div>

        @if(!empty($breeds))
            <select wire:model="breed_id" name="breed_id" class="mt-2">
                <option value="" selected>Выберите породу</option>
                @foreach($breeds as $item)
                    <option wire:click="setType({{$item['id']}})" value="{{$item['id']}}">{{$item['title_ru']}}</option>
                @endforeach
            </select>
        @endif
        @error('breed_id')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <input type="hidden" wire:model="type_id" name="type_id">
    {{--<div class="mb-2">
        <select wire:model="status_id" name="status_id">
            <option value="">Выберите статус (необязательно)</option>
            @foreach($statuses as $item)
                <option value="{{$item->id}}">{{$item->title_ru}}</option>
            @endforeach
        </select>
    </div>--}}
    <div class="mb-2">
        <input id="height" name="height" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full
            @error('height') border-red-600 @enderror"
               placeholder="Введите высоту (м)">
        @error('height')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2">
        <input id="diameter" name="diameter" min="0" max="10000" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full
            @error('diameter') border-red-600 @enderror"
               placeholder="Введите диаметер (см)">
        @error('diameter')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>
{{--    <div class="mb-2">--}}
{{--        <input id="age" name="age" min="0" max="150" inputmode="numeric" pattern="[0-9]*" type="text" class="w-full" placeholder="Введите возраст дерева">--}}
{{--    </div>--}}
{{--    <div class="mb-2">--}}
{{--        <input class="w-full mb-2" type="text" wire:model="search" placeholder="Введите породу дерева...">--}}
{{--        @if(!empty($breeds))--}}
{{--            <select wire:model="breed_id" name="breed_id">--}}
{{--                <option value="" selected>Выберите породу</option>--}}
{{--                @foreach($breeds as $item)--}}
{{--                    <option value="{{$item->id}}">{{$item->title_ru}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        @endif--}}
{{--        @error('breed_id')--}}
{{--            <div class="text-red-600">{{ $message }}</div>--}}
{{--        @enderror--}}
{{--    </div>--}}
</div>
