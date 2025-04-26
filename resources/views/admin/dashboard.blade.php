<x-app-layout>
    <div class="col-lg-12">
        <div class="row mb-3">
            <div class="col-xl-6">
                <section class="card card-featured-left card-featured-primary mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Кол-во районов</h4>
                                    <div class="info">
                                        <strong class="amount">{{\App\Models\Area::count()}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-6">
                <section class="card card-featured-left card-featured-secondary">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Кол-во мест</h4>
                                    <div class="info">
                                        <strong class="amount">{{\App\Models\Place::count()}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
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
                                        <strong class="amount">{{\App\Models\Marker::count()}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-6">
                <section class="card card-featured-left card-featured-quaternary">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-quaternary">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Кол-во пользователей</h4>
                                    <div class="info">
                                        <strong class="amount">{{\App\Models\User::count()}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <section class="card">
        <header class="card-header">
            <div class="card-actions">
                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
            </div>

            <h2 class="card-title">Посадки по пользователям</h2>
            <div class="w-100" id="chart"></div>
        </header>

    </section>
    @push("js")
        <script>

            let total = {{Js::from($total)}};
            let user_ids = {{Js::from($user_ids)}};
            let users = {{Js::from($users)}};
            let usersTotal = [];
            user_ids.forEach(item=>{
                if(users.hasOwnProperty(item)){
                    usersTotal.push(users[item])
                }
            });
            var options = {
                series: [{
                    name: 'Количество посадок',
                    type: 'column',
                    data: total
                },],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    width: [0, 4]
                },
                title: {
                    text: 'Топ 10 кураторов по посадкам'
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels:  usersTotal,
                xaxis: {
                    type: 'Имя'
                },
                yaxis: [{
                    title: {
                        text: 'Количество посадок',
                    },

                },]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endpush
</x-app-layout>
