<div class="container">
    <div class="row gap-3">
        <div class="col-12">
            <div class="relative mb-4" data-te-input-wrapper-init>
                <select wire:model="role_id" wire:change="changeRole" name="role_id" class="w-full">
                    <option value="">Все</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->title_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <p class="text-lg">Работники вне организации</p>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Имя</th>
                                    <th scope="col" class="px-6 py-4">Роль</th>
                                    <th scope="col" class="px-6 py-4 text-center">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($free_users as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->role->title_ru}}</td>
                                        <td class="flex justify-center py-4">
                                            @if($item->role_id == 2)
                                                <a href="{{route('get-user-permission',["id"=> $item->id])}}" class="mr-3">
                                                    <i class="fas fa-solid fa-chess-king"></i>
                                                </a>
                                                <a href="{{route('user-stats', $item->id)}}" class="mr-3">
                                                    <i class="fas fa-chart-line"></i>
                                                </a>
                                                <a href="{{route('user.show', $item->id)}}" class="mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <a wire:click="addUserToDepartment({{$item->id}})" class="mr-3 cursor-pointer">
                                                <i class="fas fa-arrow-right"></i>
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
        <div class="col-12 col-lg-6">
            <p class="text-lg">Работники в организации</p>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Имя</th>
                                    <th scope="col" class="px-6 py-4">Роль</th>
                                    <th scope="col" class="px-6 py-4 text-center">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($department_users as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->iteration}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->role->title_ru}}</td>
                                        <td class="flex justify-center py-4">
                                            @if($item->role_id == 2)
                                                <a href="{{route('get-user-permission',["id"=> $item->id])}}" class="mr-3">
                                                    <i class="fas fa-solid fa-chess-king"></i>
                                                </a>
                                                <a href="{{route('user-stats', $item->id)}}" class="mr-3">
                                                    <i class="fas fa-chart-line"></i>
                                                </a>
                                                <a href="{{route('user.show', $item->id)}}" class="mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <a wire:click="deleteUserFromDepartment({{$item->id}})" class="mr-3 cursor-pointer">
                                                <i class="fas fa-bucket"></i>
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
</div>
