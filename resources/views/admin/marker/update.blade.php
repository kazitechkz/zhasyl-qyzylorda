<x-app-layout>
    @push('css')
        <x-leaflet-styles></x-leaflet-styles>
    @endpush
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Изменить посадки {{$marker}}</h1>
        <form  autocomplete="off" action="{{route("markers-mass-update")}}"  method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="old_place_id" value="{{$data["place_id"]}}">

        @if(isset($types))
                <input type="hidden" name="old_type_id" value="{{$data["type_id"]}}">
                <div class="relative mb-4">
                <label>Вид насаждения</label>
                <select name="type_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($types))
                        @foreach($types as $typeItem)
                            <option
                                @if($data["type_id"] == $typeItem->id) selected @endif
                                value="{{$typeItem->id}}">
                                {{$typeItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('type_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @endif
            @if(isset($events))
                <input type="hidden" name="old_event_id" value="{{$data["event_id"]}}">

                <div class="relative mb-4">
                    <label>Хозяйственное мероприятия</label>
                    <select name="event_id" class="form-select select_2_form" >
                        <option value="">Не выбрано</option>
                        @if(count($events))
                            @foreach($events as $eventItem)
                                <option
                                    @if($data["event_id"] == $eventItem->id) selected @endif
                                    value="{{$eventItem->id}}">
                                    {{$eventItem->title_ru}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('event_id')
                    <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            @if(isset($sanitaries))
                <input type="hidden" name="old_sanitary_id" value="{{$data["sanitary_id"]}}">

                <div class="relative mb-4">
                <label>Состояние посадки</label>
                <select name="sanitary_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($sanitaries))
                        @foreach($sanitaries as $sanitaryItem)
                            <option
                                @if($data["sanitary_id"] == $sanitaryItem->id) selected @endif
                                value="{{$sanitaryItem->id}}">
                                {{$sanitaryItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('sanitary_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @endif
            @if(isset($categories))
                <input type="hidden" name="old_category_id_id" value="{{$data["category_id"]}}">

                <div class="relative mb-4">
                <label>Категория посадки</label>
                <select name="category_id" class="form-select select_2_form" >
                    <option value="">Не выбрано</option>
                    @if(count($categories))
                        @foreach($categories as $categoryItem)
                            <option
                                @if($data["category_id"] == $categoryItem->id) selected @endif
                                value="{{$categoryItem->id}}">
                                {{$categoryItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @endif
            @if(isset($breeds))
                <input type="hidden" name="old_breed_id" value="{{$data["breed_id"]}}">
            <div class="relative mb-4">
                <label>Тип насаждения</label>
                <select name="breed_id" class="form-select" >
                    <option value="">Не выбрано</option>
                    @if(count($breeds))
                        @foreach($breeds as $breedItem)
                            <option
                                @if($data["breed_id"] == $breedItem->id) selected @endif
                                value="{{$breedItem->id}}">
                                {{$breedItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('breed_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @endif
            @if(isset($status))
                <input type="hidden" name="old_status_id" value="{{$data["status_id"]}}">

                <div class="relative mb-4">
                <label>Статус посадки</label>
                <select name="status_id" class="form-select select_2_form">
                    <option value="">Не выбрано</option>
                    @if(count($status))
                        @foreach($status as $statusItem)
                            <option
                                @if($data["status_id"] == $statusItem->id) selected @endif
                                value="{{$statusItem->id}}">
                                {{$statusItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('status_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @endif

            @if($marker)
            <button
                id="submit-map"
                type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Обновить {{$marker}} посадок
            </button>
            @endif
        </form>

    </div>


</x-app-layout>
