<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Мои места') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-3">
        <div class="flex justify-end">
            {{--            <a--}}
            {{--                href="{{route('place.create')}}"--}}
            {{--                type="button"--}}
            {{--                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">--}}
            {{--                Создать--}}
            {{--            </a>--}}
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Район</th>
                                <th scope="col" class="px-6 py-4">Место</th>
                                <th scope="col" class="px-6 py-4 text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($places as $item)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($item->place->area)
                                            {{$item->place->area->title_ru}}
                                        @else
                                            Район отсутствует
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->place->title_ru}}</td>
                                    <td class="flex justify-center py-4">
                                        <a href="{{route('moder-markers', $item->place->id)}}" class="mr-3">
                                            <img src="{{asset('images/tree.svg')}}" width="30">
                                        </a>
                                        <a href="{{route('moder-bush-create', $item->place->id)}}" class="mr-3">
                                            <i class='bx bxs-tree text-black' style="font-size: 30px" ></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="my-4">
                            {!! $places->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
