<x-app-layout>
    @push("css")
        <style>
            .collapse{
                visibility: inherit!important;
            }
        </style>
    @endpush
    <div class="row pt-4 mt-2">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Районы</th>
                    <th scope="col">Возраст</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $area)
                    <tr>
                        <th style="vertical-align: middle;" scope="row" rowspan="6">{{$area->title_ru}}</th>
                        <td>< 5 лет</td>
                        <td>{{$area->get_markers_age_5_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 1])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>5 - 15 лет</td>
                        <td>{{$area->get_markers_age_5_15_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 2])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>15 - 30 лет</td>
                        <td>{{$area->get_markers_age_15_30_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 3])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>30 - 50 лет</td>
                        <td>{{$area->get_markers_age_30_50_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 4])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>50 - 100 лет</td>
                        <td>{{$area->get_markers_age_50_100_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 5])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>> 100 лет</td>
                        <td>{{$area->get_markers_age_100_count}}</td>
                        <td>
                            <a href="{{route('mayor-statistics-by-age-by-area', ['area_id' => $area->id, 'age' => 6])}}">
                                Посмотреть
                            </a>
                        </td>
                    </tr>
                @endforeach


                </tbody>

            </table>
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
</x-app-layout>
