<x-app-layout>
<div class="container">
    <div class="row pt-4 mt-2">
        <div class="col-lg-6 col-xl-6">
            <section class="card card-transparent">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
                    </div>

                    <h2 class="card-title">Статистика {{$user->name}}</h2>
                </header>
                <div class="card-body">
                    <section class="card card-group">
                        <header class="card-header bg-primary w-100">

                            <div class="widget-profile-info">
                                <div class="profile-picture w-100">
                                    <img src="https://cdn.pixabay.com/animation/2022/12/01/17/03/17-03-11-60_512.gif">
                                </div>
                                <div class="profile-info">
                                    <h4 class="name font-weight-semibold">{{$user->name}}</h4>
                                    <h5 class="role">{{$user->email}}</h5>
                                </div>
                            </div>

                        </header>

                    </section>

                </div>
            </section>
        </div>
        <div class="col-lg-6 col-xl-6">
            <section class="card card-transparent">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
                    </div>
                    <h2 class="card-title">Статистика</h2>
                </header>
                <div class="card-body">
                    <section class="card card-featured-left card-featured-tertiary mb-3">
                        <div class="card-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa-solid fa-tree"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Кол-во посадок</h4>
                                        <div class="info">
                                            <strong class="amount">{{$total}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

        </div>

    </div>
    <div class="row mt-4">
        <h2 class="card-title">Посадки по дням</h2>
        <div class="w-100" id="chart"></div>
    </div>
    <div class="row mt-4">
        <h2 class="card-title">Посадки по месяцам</h2>
        <div class="w-100" id="chart_month"></div>
    </div>
    <div class="row mt-4">
        <h2 class="card-title">Посадки по видам деревьев в дни</h2>
        <div class="w-100">
            <ul class="list-group my-4">
                @foreach($breed_day as $day => $breedVal)
                    <li class="list-group-item">
                        <h2 class="card-title">Посадки в {{$day}}</h2>
                        <ul class="list-group my-4">

                            @foreach($breed_day[$day] as $breed_stat)
                                <li class="list-group-item">
                                @if($breed_stat["breed"])
                                {{$breed_stat["breed"]["title_ru"]}}
                                @else
                                    Возможно дерево было удалено
                                @endif
                                    - {{$breed_stat["count"]}} шт.
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>



    @push("js")
        <script>

            let total_day = {{Js::from($info_day->pluck("date"))}};
            let total_marker = {{Js::from($info_day->pluck("total"))}};
            let total_month = {{Js::from($info_month->pluck("month"))}};
            let total_marker_month = {{Js::from($info_month->pluck("total"))}};
            var options = {
                series: [{
                    name: 'Количество посадок',
                    type: 'column',
                    data: total_marker
                },],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    width: [0, 4]
                },
                title: {
                    text: 'Посадки по дням'
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels:  total_day,
                xaxis: {
                    type: 'Дата'
                },
                yaxis: [{
                    title: {
                        text: 'Количество посадок',
                    },

                },]
            };
            var month_options = {
                series: [{
                    name: 'Количество посадок',
                    type: 'column',
                    data: total_marker_month
                },],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    width: [0, 4]
                },
                title: {
                    text: 'Посадки по месяцам'
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels:  total_month,
                xaxis: {
                    type: 'Дата'
                },
                yaxis: [{
                    title: {
                        text: 'Количество посадок',
                    },

                },]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            var chart_month = new ApexCharts(document.querySelector("#chart_month"), month_options);
            chart.render();
            chart_month.render();
        </script>
    @endpush

</x-app-layout>
