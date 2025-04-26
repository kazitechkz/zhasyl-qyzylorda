<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Породы') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-3">
        <div class="flex justify-end">
            <a
                href="{{route('moder-breed.create')}}"
                type="button"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Создать
            </a>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Наименование на русском</th>
                                <th scope="col" class="px-6 py-4">Наименование на казахском</th>
                                <th scope="col" class="px-6 py-4">Изображение</th>
                                <th scope="col" class="px-6 py-4">Коэффициент</th>
                                <th scope="col" class="px-6 py-4 text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($breeds as $item)
                                <tr class="border-b dark:border-neutral-500 @if($item->status == env('APP_MODER_ROLE',2)) text-danger-700 font-weight-extra-bold @endif">
{{--                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$breeds->firstItem() + $loop->index}}</td>--}}
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->title_ru}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->title_kz}}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <img src="{{$item->getBreedImage('image_url')}}" width="50px">
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$item->coefficient}}</td>
                                    <td class="flex justify-center py-4">
                                        @if(auth()->user()->can_do("edit breed"))
                                            <a href="{{route('moder-breed.edit', $item->id)}}" class="mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="my-4">
                            {!! $breeds->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
