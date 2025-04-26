<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Сообщения об ошибках') }}
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
                                <th scope="col" class="px-6 py-4">Номер маркера</th>
                                <th scope="col" class="px-6 py-4">ФИО</th>
                                <th scope="col" class="px-6 py-4">Телефон</th>
                                <th scope="col" class="px-6 py-4">Email</th>
                                <th scope="col" class="px-6 py-4">Сообщение</th>
                                <th scope="col" class="px-6 py-4">Ответы</th>
                                <th scope="col" class="px-6 py-4">Статус</th>
                                <th scope="col" class="px-6 py-4 text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($reports))
                                @foreach($reports as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$reports->firstItem() + $loop->index}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->marker_id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->phone}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->email}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->message}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->answer}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @switch($item->status)
                                                @case(0)
                                                    Не отвеченный
                                                    @break
                                                @case(1)
                                                    Отвечен
                                                    @break
                                                @default
                                                    -
                                            @endswitch

                                        </td>

                                        <td class="flex justify-center py-4">
                                            <a href="{{route('reports.edit', $item->id)}}" class="mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{route('reports.destroy', $item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Вы уверены ?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
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
                            {!! $reports->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
