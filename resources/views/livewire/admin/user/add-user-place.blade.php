<div>
    <form wire:submit.prevent="submit" method="post">
        @csrf

        <div class="relative mb-4" data-te-input-wrapper-init>
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label>Выберите район</label>
                <select wire:change="getPlacesByAreaId" name="area_id" wire:model="areaId" class="w-full" data-te-select-init>
                    <option value="0" selected>Все</option>
                    @foreach($areas as $item)
                        <option value="{{$item->id}}">{{$item->title_ru}}</option>
                    @endforeach
                </select>
            </div>

            @if($show)
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <input wire:model="search" type="search" class="w-full" placeholder="Поиск мест..." />
{{--                    <ul class="my-3">--}}
{{--                        @if(!empty($places))--}}
{{--                            @foreach($places as $place)--}}
{{--                                <li>--}}
{{--                                    <div wire:click="addPlace({{$place->id}})" class="relative mb-4 flex flex-wrap items-stretch cursor-pointer">--}}
{{--                                  <span--}}
{{--                                      class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] dark:border-neutral-600"--}}
{{--                                      id="basic-addon1"--}}
{{--                                  >+</span--}}
{{--                                  >--}}
{{--                                        <input--}}
{{--                                            disabled--}}
{{--                                            type="text"--}}
{{--                                            class="relative m-0 block w-[1px] min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:focus:border-primary"--}}
{{--                                            placeholder="{{ $place->title_ru }}" />--}}
{{--                                    </div>--}}

{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </ul>--}}
                </div>
            @endif
        </div>

    </form>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-7 overflow-x-scroll">
                            <table class="min-w-full text-left text-sm font-light overflow-scroll">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Наименование</th>
                                    <th scope="col" class="px-6 py-4">Кол-во</th>
                                    <th scope="col" class="px-6 py-4 text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($placesWithMarkers)
                                    @foreach($placesWithMarkers as $item)
                                        <tr class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{$placesWithMarkers->firstItem() + $loop->index}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->title_ru}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->markers->count()}}</td>
                                            <td class="flex justify-center py-4">
                                                <a wire:click="addPlace({{$item->id}})" class="cursor-pointer">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="p-3">
                                {{$placesWithMarkers->links()}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-5 overflow-x-scroll">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Наименование</th>
                                    <th scope="col" class="px-6 py-4 text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userPlaces as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->place->title_ru}}</td>
                                        <td class="flex justify-center py-4">
                                            <a wire:click="deletePlace({{$item->id}})" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
