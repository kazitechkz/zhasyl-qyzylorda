<x-app-layout>
    @push("css")
        <style>
            .collapse{
                visibility: visible;!important;
            }
        </style>
    @endpush


    <div class="container">
        <div class="row">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Фильтры
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{route("markers-edit")}}">
                                <div class="row">
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Место*</label>
                                        <select
                                            id="place_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('place_id') border-red-600 @enderror"
                                            name="place_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($places as $placeItem)
                                                <option value="{{$placeItem->id}}">
                                                    {{$placeItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Насаждения*</label>
                                        <select
                                            id="breed_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="breed_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($breeds as $breedItem)
                                                <option value="{{$breedItem->id}}">
                                                    {{$breedItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Категория</label>
                                        <select
                                            id="category_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="category_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($categories as $categoryItem)
                                                <option value="{{$categoryItem->id}}">
                                                    {{$categoryItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Мероприятия</label>
                                        <select
                                            id="event_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="event_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($events as $eventItem)
                                                <option value="{{$eventItem->id}}">
                                                    {{$eventItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Состояние</label>
                                        <select
                                            id="sanitaries_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="sanitary_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($sanitaries as $sanitaryItem)
                                                <option value="{{$sanitaryItem->id}}">
                                                    {{$sanitaryItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Статусы</label>
                                        <select
                                            id="status_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="status_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($status as $statusItem)
                                                <option value="{{$statusItem->id}}">
                                                    {{$statusItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 my-2">
                                        <label>Типы</label>
                                        <select
                                            id="type_ids"
                                            class="form-select w-full mw-full py-5 mb-4 @error('category_id') border-red-600 @enderror"
                                            name="type_id">
                                            <option value="">Не выбрано</option>
                                            @foreach($types as $typeItem)
                                                <option value="{{$typeItem->id}}">
                                                    {{$typeItem->title_ru}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6 my-2 flex justify-content-center items-center justify-content-center">
                                        <button class="btn btn-info w-full d-inline-block">Поиск</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@push('js')
    <script>
        $("select").select2();
    </script>

@endpush
</x-app-layout>
