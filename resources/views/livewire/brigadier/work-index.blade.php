<div class="container">
    <div class="row my-2">
        <div class="col-12 col-md-6 col-lg-3">
            <input
                wire:change="changeToStart"
                id="start_at"
                type="text"
                class="peer block min-h-[auto] w-full rounded border-1"
                wire:model="start_at"
                name="start_at"
                value="{{old('start_at')}}"
                placeholder="Дата начала" />
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <input
                wire:change="changeToEnd"
                id="end_at"
                type="text"
                class="peer block min-h-[auto] w-full rounded border-1"
                wire:model="end_at"
                name="end_at"
                value="{{old('end_at')}}"
                placeholder="Дата окончания" />
        </div>

    </div>

    @if(count($works))
        <div class="row my-2">
            <div class="col-12">
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
                                        <th scope="col" class="px-6 py-4">Департамент</th>
                                        <th scope="col" class="px-6 py-4">Работник</th>
                                        <th scope="col" class="px-6 py-4">Дата начала</th>
                                        <th scope="col" class="px-6 py-4">Дата окончания</th>
                                        <th scope="col" class="px-6 py-4 text-center">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($works as $item)
                                        <tr class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->chief->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->title}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->department->title}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->user->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->start_at->format('H:i d.m.Y')}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$item->end_at->format('H:i d.m.Y')}}</td>
                                            <td class="flex justify-center py-4">
                                                <a href="{{route('brigadier-work-result.edit', $item->id)}}" class="mr-3">
                                                    <i class="fas fa-message"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push("js")
    <script>
        $('#start_at').flatpickr({
            dateFormat: "H:i d.m.Y",
            enableTime: true,
            time_24hr: true
        });
        $('#end_at').flatpickr({
            dateFormat: "H:i d.m.Y",
            enableTime: true,
            time_24hr: true
        });


    </script>
@endpush
