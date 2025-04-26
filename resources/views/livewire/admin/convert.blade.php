<div>
    <select class="w-full" id="type_id">
        <option wire:click="getMarkers(0)">Выберите тип</option>
        @foreach($types as $type)
            <option wire:click="getMarkers({{$type->id}})" value="{{$type->id}}">{{$type->title_ru}}</option>
        @endforeach
    </select>

    <button class="btn btn-success bg-success my-3" type="button" wire:click="convert">Актуализировать</button>
    <div wire:loading>
        <img src="{{asset('images/loading.gif')}}" width="30" height="30">
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Порода</th>
                            <th scope="col" class="px-6 py-4">Количество</th>
{{--                            <th scope="col" class="px-6 py-4 text-center">Действие</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $item)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($item->breed)
                                            {{$item->breed->title_ru}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{$item->total}}
                                    </td>
{{--                                    <td class="flex justify-center py-4">--}}
{{--                                        <button wire:click="convert({{$item->breed_id}})" type="button" class="cursor-pointer">--}}
{{--                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">--}}
{{--                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">--}}
{{--                                                    <path d="M19 11V9a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L12 2.757V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L2.929 4.343a1 1 0 0 0 0 1.414l.536.536L2.757 8H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535L8 17.243V18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H18a1 1 0 0 0 1-1Z"/>--}}
{{--                                                    <path d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>--}}
{{--                                                </g>--}}
{{--                                            </svg>--}}
{{--                                        </button>--}}

{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="my-4">
{{--                        {!! $trees->links() !!}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
