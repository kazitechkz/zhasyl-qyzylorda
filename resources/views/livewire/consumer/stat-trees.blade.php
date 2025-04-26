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

    <div class="row">
        <div class="col-12">
            @if($areaStat || $placeStat)
                <div class="table-responsive">
                    <button id="button" class="btn btn-info my-2" onclick="htmlTableToExcel('xlsx')">ЭКСПОРТ В EXCEL</button>
                    <table class="table" id="tblToExcl">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">#ID</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Район</th>
                            <th scope="col">Всего</th>
                            <th scope="col">Здоровые</th>
                            <th scope="col">Ослабленные (повреждение 25% - 50%)</th>
                            <th scope="col">Усыхающие (повреждение более 50%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                            $total_health = 0;
                            $total_bad = 0;
                            $total_critic = 0;
                        @endphp
                        @foreach($breeds as $breedItem)
                            @php
                                $total += $breedItem["breed_total"];
                            @endphp
                            <tr>
                                <th class="font-normal">{{$loop->iteration}}</th>
                                <th class="font-normal text-info">{{$breedItem["breed_id"]}}</th>
                                <th class="font-normal">{{$breedItem["breed"]["title_ru"]}}</th>
                                <th class="font-normal">
                                    @if($placeStat)
                                        {{$breedItem["place"]["title_ru"]}}
                                    @endif
                                    @if($areaStat)
                                        {{$breedItem["area"]["title_ru"]}}
                                    @endif
                                </th>
                                <th class="font-bold">{{$breedItem["breed_total"]}}</th>
                                <th class="font-normal text-success">
                                    @if(key_exists(1,$breedItem["sanitaries"]))
                                        @php
                                            $total_health +=$breedItem["sanitaries"][1]["breed_total"];
                                        @endphp
                                        {{$breedItem["sanitaries"][1]["breed_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>
                                <th class="font-normal text-warning">
                                    @if(key_exists(2,$breedItem["sanitaries"]))
                                        @php
                                            $total_bad +=$breedItem["sanitaries"][2]["breed_total"];
                                        @endphp
                                        {{$breedItem["sanitaries"][2]["breed_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>

                                <th class="font-normal text-danger">
                                    @if(key_exists(3,$breedItem["sanitaries"]))
                                        @php
                                            $total_critic +=$breedItem["sanitaries"][3]["breed_total"];
                                        @endphp
                                        {{$breedItem["sanitaries"][3]["breed_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">Итого</th>
                            <th colspan="1">{{$total}}</th>
                            <td class="text-success">{{$total_health}}</td>
                            <td class="text-warning">{{$total_bad}}</td>
                            <td class="text-red-500">{{$total_critic}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="col-12">
            @if($areaStat || $placeStat)
                <div class="table-responsive">
                    <button id="button" class="btn btn-info my-2" onclick="htmlTableToExcel_3('xlsx')">ЭКСПОРТ В EXCEL</button>
                    <table class="table" id="tblToExcl_3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">#ID</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Район</th>
                            <th scope="col">Всего (метров)</th>
                            <th scope="col">Здоровые (метров) </th>
                            <th scope="col">Ослабленные (повреждение 25% - 50%) (метров)</th>
                            <th scope="col">Усыхающие (повреждение более 50%) (метров)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                            $total_health = 0;
                            $total_bad = 0;
                            $total_critic = 0;
                        @endphp
                        @foreach($bushes as $bushItem)
                            @php
                                $total += $bushItem["length_total"];
                            @endphp
                            <tr>
                                <th class="font-normal">{{$loop->iteration}}</th>
                                <th class="font-normal text-info">{{$bushItem["breed_id"]}}</th>
                                <th class="font-normal">{{$bushItem["breed"]["title_ru"]}}</th>
                                <th class="font-normal">
                                    @if($placeStat)
                                        {{$bushItem["place"]["title_ru"]}}
                                    @endif
                                    @if($areaStat)
                                        {{$bushItem["area"]["title_ru"]}}
                                    @endif
                                </th>
                                <th class="font-bold">{{$bushItem["length_total"]}}</th>
                                <th class="font-normal text-success">
                                    @if(key_exists(1,$bushItem["sanitaries"]))
                                        @php
                                            $total_health +=$bushItem["sanitaries"][1]["length_total"];
                                        @endphp
                                        {{$bushItem["sanitaries"][1]["length_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>
                                <th class="font-normal text-warning">
                                    @if(key_exists(2,$bushItem["sanitaries"]))
                                        @php
                                            $total_bad +=$bushItem["sanitaries"][2]["length_total"];
                                        @endphp
                                        {{$bushItem["sanitaries"][2]["length_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>

                                <th class="font-normal text-danger">
                                    @if(key_exists(3,$bushItem["sanitaries"]))
                                        @php
                                            $total_critic +=$bushItem["sanitaries"][3]["length_total"];
                                        @endphp
                                        {{$bushItem["sanitaries"][3]["length_total"]}}
                                    @else
                                        0
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">Итого</th>
                            <th colspan="1">{{$total}}</th>
                            <td class="text-success">{{$total_health}}</td>
                            <td class="text-warning">{{$total_bad}}</td>
                            <td class="text-red-500">{{$total_critic}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="col-12">
            @if($areaStat || $placeStat)
                <div class="table-responsive">
                    <button id="button" class="btn btn-info my-2" onclick="htmlTableToExcel_2('xlsx')">ЭКСПОРТ В EXCEL</button>
                    <table class="table" id="tblToExcl_2">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Кол-во</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $typeItem)
                            <tr>
                                <th class="font-normal">{{$loop->iteration}}</th>
                                <th class="font-normal">{{$typeItem["type"]["title_ru"]}}</th>
                                <th class="font-normal">{{$typeItem["breed_total"]}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif


        </div>

    </div>


</div>
@push("js")
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function htmlTableToExcel(type){
            var data = document.getElementById('tblToExcl');
        }
    </script>
@endpush
