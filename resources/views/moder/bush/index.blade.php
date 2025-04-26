<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Кустарники') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-3">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Места</th>
                                <th scope="col" class="px-6 py-4">Тип посадки</th>
                                <th scope="col" class="px-6 py-4">Тип состояния</th>
                                <th scope="col" class="px-6 py-4">Тип насаждения</th>
                                <th scope="col" class="px-6 py-4">Ширина</th>
                                <th scope="col" class="px-6 py-4">Длина</th>
                                <th scope="col" class="px-6 py-4">Высота</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bushes))
                                @foreach($bushes as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$bushes->firstItem() + $loop->index}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if($item->place)
                                                {{$item->place->title_ru}}
                                            @else
                                                Места отсутствуют
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if($item->type)
                                                {{$item->type->title_ru}}
                                            @else
                                                Тип посадки отсутствует
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if($item->sanitary)
                                                {{$item->sanitary->title_ru}}
                                            @else
                                                Тип состояния отсутствует
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if($item->breed)
                                                {{$item->breed->title_ru}}
                                            @else
                                                Тип насаждения отсутствует
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$item->width}} (см)</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$item->length}} (м)</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$item->height}} (cм)</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">Ничего не найдено</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="my-4">
                            {!! $bushes->appends(request()->except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
