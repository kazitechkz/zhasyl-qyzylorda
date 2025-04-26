<div class="container">
    <div class="row my-2">
        <div class="col-12 col-md-6 col-lg-3">
            <select wire:model="department_id" wire:change="changeDepartment" name="department_id" class="w-full">
                <option value="">Выберите отдел</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->title}}</option>
                @endforeach
            </select>
            @error('department_id')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>
        @if($users)
            <div class="col-12 col-md-6 col-lg-3">
                <select wire:model="user_id" name="user_id" class="w-full">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}} ({{$user->role->title_ru}})</option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        @endif
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
                                                <a href="{{route('chef-work.edit', $item->id)}}" class="mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                    </svg>
                                                </a>
                                                <form action="{{route('chef-work.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Вы уверены ?')" class="cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
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
