<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Мои точки') }}
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
                                <th scope="col" class="px-6 py-4">Вид</th>
                                <th scope="col" class="px-6 py-4">Возраст</th>
                                <th scope="col" class="px-6 py-4">Дата посадки</th>
                                <th scope="col" class="px-6 py-4">Высота</th>
                                <th scope="col" class="px-6 py-4">Диаметр</th>
                                <th scope="col" class="px-6 py-4 text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trees as $item)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$trees->firstItem() + $loop->index}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->place->title_ru}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($item->breed)
                                            {{$item->breed->title_ru}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->age}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($item->landing_date)
                                            {{\Carbon\Carbon::parse($item->landing_date)->format('d-m-Y')}}
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->height}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->diameter}}</td>
                                    <td class="flex justify-center py-4">
                                        <a href="{{route('trees.show', $item->id)}}" class="mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <form action="{{route('trees.destroy', $item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Вы уверены ?')" type="submit" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="my-4">
                            {!! $trees->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

