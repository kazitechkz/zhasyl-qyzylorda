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
        <div class="col-md-4 my-2 px-2">
            <div class="form-group">
                <label>Вид насаждения</label>
                <select class="form-control" wire:model="breed_id">
                    <option>Не выбрано</option>
                    @foreach($breeds as $breed)
                        <option value="{{$breed->id}}">{{$breed->title_ru}} ({{$breed->type->title_ru}})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="form-group">
                <label>Категория мест</label>
                <select class="form-control" wire:model="category_id">
                    <option>Не выбрано</option>
                    @foreach($categoryPlaces as $category)
                        <option value="{{$category->id}}">{{$category->title_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    @if($places != null)

        <div class="row py-3 px-3 bg-white">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Таблица видов деревьев по местам
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
                                        <th scope="col">Район</th>
                                        <th scope="col">Наименование места</th>
                                        <th scope="col">Наименование вида</th>
                                        <th scope="col">Кол-во</th>
                                    </tr>
                                    </thead>
                                    @foreach($places as $placeItem)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{$placeItem->place->area->title_ru}}</td>
                                            <td>{{$placeItem->place->title_ru}} ({{$placeItem->place->category->title_ru}})</td>
                                            <td>{{$placeItem->breed->title_ru}}</td>
                                            <td class="text-success font-bold">{{$placeItem->breed_total}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="4">Итого</th>
                                        <td class="text-green-500 font-bold">{{$count}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endif
</div>
</div>
@push("js")
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function htmlTableToExcel(type){
            var data = document.getElementById('tblToExcl');
            var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
            XLSX.writeFile(excelFile, 'Вид деревьев по местам.' + type);
        }
    </script>
@endpush
