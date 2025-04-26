
<x-app-layout>
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Результат работы</h1>
        <div class="container mx-auto py-3">
            <div class="col-12 my-3">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Начальник</th>
                                        <th scope="col" class="px-6 py-4">Наименование</th>
                                        <th scope="col" class="px-6 py-4">Описание</th>
                                        <th scope="col" class="px-6 py-4">Департамент</th>
                                        <th scope="col" class="px-6 py-4">Работник</th>
                                        <th scope="col" class="px-6 py-4">Дата начала</th>
                                        <th scope="col" class="px-6 py-4">Дата окончания</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$work->id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->chief->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->title}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{!! $work->description !!}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->department->title}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->user->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->start_at->format('H:i d.m.Y')}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$work->end_at->format('H:i d.m.Y')}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-3">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Наименование работы</th>
                                        <th scope="col" class="px-6 py-4">Начальник</th>
                                        <th scope="col" class="px-6 py-4">Работник</th>
                                        <th scope="col" class="px-6 py-4">Коммент</th>
                                        <th scope="col" class="px-6 py-4">Статус</th>
                                        <th scope="col" class="px-6 py-4">Дата исполнения</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$result->id}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$result->work->title}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$result->work->chief->name}} ({{$result->work->chief->email}})</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$result->user->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{!! $result->comment !!}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$result->status == 1 ? 'Выполнено' : 'Не Выполнено'}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$result->work->start_at->format('H:i d.m.Y')}}- {{$result->work->end_at->format('H:i d.m.Y')}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

