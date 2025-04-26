<div>
    <div>
        <div class="my-2 flex">
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label>Выберите место</label>
                <select wire:model="place_id" class="w-full" data-te-select-init>
                    <option value="0" selected>Все</option>
                    @foreach($places as $item)
                        <option value="{{$item->id}}">{{$item->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative mb-4 mx-3" data-te-input-wrapper-init>
                <label>Выберите породу</label>
                <select wire:model="breed_id" class="w-full" data-te-select-init>
                    <option value="0" selected>Все</option>
                    @foreach($breeds as $item)
                        <option value="{{$item->id}}">{{$item->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label>Выберите состояние</label>
                <select wire:model="sanitary_id" class="w-full" data-te-select-init>
                    <option value="0" selected>Все</option>
                    @foreach($sanitaries as $item)
                        <option value="{{$item->id}}">{{$item->title_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="my-2">
            Общее: {{$markers->total()}}
        </div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
                <th scope="col" class="px-6 py-4">#</th>
                <th scope="col" class="px-6 py-4">Район</th>
                <th scope="col" class="px-6 py-4">Место</th>
                <th scope="col" class="px-6 py-4">Порода</th>
                <th scope="col" class="px-6 py-4">Состояние</th>
                <th scope="col" class="px-6 py-4">Возраст</th>
                <th scope="col" class="px-6 py-4">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($markers as $item)
                <tr class="border-b dark:border-neutral-500">
                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$markers->firstItem() + $loop->index}}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if($item->area)
                           {{$item->area->title_ru}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if($item->place)
                            {{$item->place->title_ru}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if($item->breed)
                            {{$item->breed->title_ru}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if($item->sanitary)
                            {{$item->sanitary->title_ru}}
                        @else
                            -
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{$item->age}}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        <a href="{{route('mayor-marker-show', ["id"=>$item->id])}}" class="mr-3">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-3">
            {{$markers->links('vendor.livewire.bootstrap')}}
        </div>
    </div>
</div>
