@push("css")
    <style>
        .collapse{
            visibility: inherit!important;
        }
    </style>
@endpush

<div class="container">
    <div class="row py-3 px-3 bg-white">
        <div class="col-md-4 my-2 px-2">
            <div class="form-group">
                <label>Район</label>
                <select class="form-control" wire:model="area_id">
                    <option>Не выбрано</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->title_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($places)
            <div class="col-md-4 my-2 px-2">
                <div class="form-group">
                    <label>Категория места</label>
                    <select class="form-control" wire:model="category_id">
                        <option>Не выбрано</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title_ru}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 my-2 px-2">
                <div class="form-group">
                    <label>Место</label>
                    <select class="form-control" wire:model="place_id">
                        <option>Не выбрано</option>
                        @foreach($places as $place)
                            <option value="{{$place->id}}">{{$place->title_ru}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

    </div>

    @if($places != null && $place != null)

        <div class="row py-3 px-3 bg-white">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Таблица улиц
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <button id="button" class="btn btn-info my-2" onclick="htmlTableToExcel('xlsx')">ЭКСПОРТ В EXCEL</button>
                                <table class="table" id="tblToExcl">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Наименование</th>
                                        <th scope="col">Категория</th>
                                        <th scope="col">Здоровые</th>
                                        <th scope="col">Ослабленные (повреждение 25% - 50%)</th>
                                        <th scope="col">Усыхающие (повреждение более 50%)</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $total_health = 0;
                                        $total_bad = 0;
                                        $total_critic = 0;
                                    @endphp
                                    @foreach($places as $placeItem)
                                        @php
                                            $total_health +=$placeItem->sanitary_health;
                                            $total_bad +=$placeItem->sanitary_bad;
                                            $total_critic +=$placeItem->sanitary_critic;
                                        @endphp
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$placeItem->title_ru}}</td>
                                            <td>{{$placeItem->category->title_ru}}</td>
                                            <td class="text-success">{{$placeItem->sanitary_health}}</td>
                                            <td class="text-warning">{{$placeItem->sanitary_bad}}</td>
                                            <td class="text-red-500">{{$placeItem->sanitary_critic}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3">Итого</th>
                                        <td class="text-success">{{$total_health}}</td>
                                        <td class="text-warning">{{$total_bad}}</td>
                                        <td class="text-red-500">{{$total_critic}}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="5">Общий итог</th>
                                        <td class="text-dark">{{$total_health + $total_bad + $total_critic}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if($place_id != null && count($breeds)>0)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Данные о посадках деревьев
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if(count($breeds)>0)
                                    @if(isset($breeds[1]))
                                        <div class="row py-3 px-3 bg-white">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Наименование</th>
                                                        <th scope="col">Состояние</th>
                                                        <th scope="col">Количество</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($breeds[1] as $breed_item)
                                                        <tr>
                                                            <th class="text-success">{{$breed_item->breed ? $breed_item->breed->title_ru : $breed_item->breed_id}}</th>
                                                            <th class="text-success">Здоровые</th>
                                                            <td>{{$breed_item->breed_total}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>
                                    @endif
                                    @if(isset($breeds[2]))
                                        <div class="row py-3 px-3 bg-white">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Наименование</th>
                                                        <th scope="col">Состояние</th>
                                                        <th scope="col">Количество</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($breeds[2] as $breed_item)
                                                        <tr>
                                                            <th class="text-warning">{{$breed_item->breed ? $breed_item->breed->title_ru : $breed_item->breed_id}}</th>
                                                            <th class="text-warning">Ослабленные (повреждение 25% - 50%)</th>
                                                            <td>{{$breed_item->breed_total}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>
                                    @endif
                                    @if(isset($breeds[3]))
                                        <div class="row py-3 px-3 bg-white">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Наименование</th>
                                                        <th scope="col">Состояние</th>
                                                        <th scope="col">Количество</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($breeds[3] as $breed_item)
                                                        <tr>
                                                            <th class="text-danger">{{$breed_item->breed ? $breed_item->breed->title_ru : $breed_item->breed_id}}</th>
                                                            <th class="text-danger">Усыхающие (повреждение более 50%)</th>
                                                            <td>{{$breed_item->breed_total}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>


        </div>
    @endif



</div>
@push("js")
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function htmlTableToExcel(type){
            var data = document.getElementById('tblToExcl');
            var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
            XLSX.writeFile(excelFile, 'Состояние деревьев.' + type);
        }
    </script>
@endpush


