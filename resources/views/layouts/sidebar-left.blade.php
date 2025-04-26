
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Навигация
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                @admin
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'admin-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'user.index'"
                        :route-name="'Пользователи'"
                        :icon="'bx bxs-user'"
                    />
                    <x-sidebar-navlink
                        :route="'area.index'"
                        :route-name="'Районы'"
                        :icon="'bx bxs-map-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'admin-maps'"
                        :route-name="'Карта'"
                        :icon="'bx bxs-map-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'place.index'"
                        :route-name="'Места'"
                        :icon="'bx bx-map-pin'"
                    />
                    <x-sidebar-navlink
                        :route="'bush.index'"
                        :route-name="'Кусты'"
                        :icon="'bx bxs-tree'"
                    />
                    <x-sidebar-navlink
                        :route="'admin-check-users'"
                        :route-name="'Геопозиция кураторов'"
                        :icon="'bx bx-current-location'"
                    />
                    <x-sidebar-navlink
                        :route="'markers'"
                        :route-name="'Изменить насаждения'"
                        :icon="'fas fa-pen'"
                    />
                    <x-sidebar-navlink
                        :route="'admin-convert'"
                        :route-name="'Конвертировать'"
                        :icon="'fas fa-spinner'"
                    />
                    <x-sidebar-navlink
                        :route="'all-trees'"
                        :route-name="'Просмотр насаждений'"
                        :icon="'fas fa-map'"
                    />
                    <x-sidebar-navlink
                        :route="'get-all-markers'"
                        :route-name="'Деревья'"
                        :icon="'fa fa-tree'"
                    />
                    <x-sidebar-navlink
                        :route="'reports.index'"
                        :route-name="'Сообщения'"
                        :icon="'fas fa-solid fa-exclamation'"
                    />
                    <x-sidebar-navlink
                        :route="'back-up'"
                        :route-name="'Дамп БД'"
                        :icon="'fas fa-database'"
                    />
                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="bx bx-file" aria-hidden="true"></i>
                            <span> Модуль справочных данных</span>
                        </a>
                        <ul class="nav nav-children">
                            <x-sidebar-navlink
                                :route="'breed.index'"
                                :route-name="'Породы'"
                                :icon="'bx bxs-category'"
                                :count="$counts"
                            />
                            <x-sidebar-navlink
                                :route="'category.index'"
                                :route-name="'Категория насаждений'"
                                :icon="'bx bxl-mongodb'"
                            />
                            <x-sidebar-navlink
                                :route="'sanitary.index'"
                                :route-name="'Состояния'"
                                :icon="'bx bx-heart'"
                            />
                            <x-sidebar-navlink
                                :route="'status.index'"
                                :route-name="'Статусы'"
                                :icon="'bx bx-star'"
                            />
                            <x-sidebar-navlink
                                :route="'event.index'"
                                :route-name="'Хозяйственные мероприятия'"
                                :icon="'bx bxs-calendar-event'"
                            />
                            <x-sidebar-navlink
                                :route="'type.index'"
                                :route-name="'Виды насаждений'"
                                :icon="'bx bxs-tree-alt'"
                            />
                            <x-sidebar-navlink
                                :route="'sanitary_type.index'"
                                :route-name="'Иконки насаждений'"
                                :icon="'bx bxs-camera'"
                            />
                        </ul>
                    </li>
                    <x-sidebar-navlink
                        :route="'create-token'"
                        :route-name="'Токены'"
                        :icon="'fas fa-key'"
                    />
                    <x-sidebar-navlink
                        :route="'private-policy.index'"
                        :route-name="'Политика конфиденциальности'"
                        :icon="'fa-brands fa-old-republic'"
                    />
                </ul>
                @endadmin
                @moder
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'moder-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'moder-places'"
                        :route-name="'Мои места'"
                        :icon="'bx bx-map-pin'"
                    />
                    <x-sidebar-navlink
                        :route="'trees.index'"
                        :route-name="'Точки'"
                        :icon="'bx bx-street-view'"
                    />
                    <x-sidebar-navlink
                        :route="'moder-bush-index'"
                        :route-name="'Кусты'"
                        :icon="'bx bxs-tree'"
                    />
                    <x-sidebar-navlink
                        :route="'moder-maps'"
                        :route-name="'Карта'"
                        :icon="'bx bxs-map-alt'"
                    />
                    @if(auth()->user()->can_do("add breed"))
                        <x-sidebar-navlink
                            :route="'moder-breed.index'"
                            :route-name="'Породы'"
                            :icon="'bx bxs-category'"
                        />
                    @endif

                </ul>
                @endmoder
                @mayor
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'mayor-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'mayor-statistics'"
                        :route-name="'Статистика'"
                        :icon="'bx bx-pie-chart-alt-2'"
                    />
                    <x-sidebar-navlink
                        :route="'mayor-statistics-by-trees'"
                        :route-name="'Статистика По Состоянию'"
                        :icon="'bx bx-stats'"
                    />
                    <x-sidebar-navlink
                        :route="'mayor-statistics-tree'"
                        :route-name="'Статистика по деревьям'"
                        :icon="'bx bx-network-chart'"
                    />
                    <x-sidebar-navlink
                        :route="'mayor-statistics-breed-place'"
                        :route-name="'Статистика по видам'"
                        :icon="'bx bx-scatter-chart'"
                    />
                    <x-sidebar-navlink
                        :route="'mayor-statistics-by-age'"
                        :route-name="'Статистика по возрасту'"
                        :icon="'bx bx-line-chart'"
                    />
                </ul>
                @endmayor
                @agronom
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'agronom-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'agronom-statistics'"
                        :route-name="'Статистика'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'agronom-statistics-by-trees'"
                        :route-name="'Статистика По Состоянию'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'all-trees'"
                        :route-name="'Просмотр насаждений'"
                        :icon="'fas fa-map'"
                    />
                    <x-sidebar-navlink
                        :route="'agronom-statistics-tree'"
                        :route-name="'Статистика по деревьям'"
                        :icon="'bx bx-home-alt'"
                    />
                </ul>
                @endagronom
                @consumer
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'consumer-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'consumer-statistics'"
                        :route-name="'Статистика'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'consumer-statistics-by-trees'"
                        :route-name="'Статистика По Состоянию'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'consumer-statistics-tree'"
                        :route-name="'Статистика по деревьям'"
                        :icon="'bx bx-home-alt'"
                    />
                </ul>
                @endconsumer
                @chef
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'chef-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'chef-user.index'"
                        :route-name="'Пользователи'"
                        :icon="'bx bx-user'"
                    />
                    <x-sidebar-navlink
                        :route="'chef-department.index'"
                        :route-name="'Отдел'"
                        :icon="'bx bx-building'"
                    />
                    <x-sidebar-navlink
                        :route="'chef-work.index'"
                        :route-name="'Работа'"
                        :icon="'bx bx-briefcase'"
                    />
                </ul>
                @endchef
                @agronomist
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'agronomist-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'agronomist-work-result.index'"
                        :route-name="'Отчеты'"
                        :icon="'bx bx-briefcase'"
                    />
                </ul>
                @endagronomist
                @brigadier
                <ul class="nav nav-main">
                    <x-sidebar-navlink
                        :route="'brigadier-dashboard'"
                        :route-name="'Главная'"
                        :icon="'bx bx-home-alt'"
                    />
                    <x-sidebar-navlink
                        :route="'brigadier-work-result.index'"
                        :route-name="'Отчеты'"
                        :icon="'bx bx-briefcase'"
                    />
                </ul>
                @endbrigadier
                <ul class="nav nav-main">
                    <li class="nav-parent">
                        <form action="{{route("logout")}}" method="post">
                            @csrf
                            <button style="padding: 12px 25px; color: white" type="submit" class="nav-link">
                                <i class="fas fa-power-off" aria-hidden="true"></i>
                                <span>Выход</span>
                            </button>
                        </form>
                    </li>
                </ul>

            </nav>
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>

