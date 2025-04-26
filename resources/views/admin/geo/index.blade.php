<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Геопозиция кураторов') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-3">

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Имя</th>
                                <th scope="col" class="px-6 py-4">Статус</th>
                                <th scope="col" class="px-6 py-4 text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody id="online-user">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("js")
        <script type="module">
            let usersOnline = [];
            Echo.join("user-presence")
                .here((users)=>{
                    usersOnline = users;
                    updateTable();
                })
                .joining((user) => {
                    usersOnline.push(user);
                    updateTable();
                })
                .leaving((user) => {
                    usersOnline = usersOnline.filter((item)=>{
                        return item.id != user.id
                    });
                    updateTable();
                });





            function updateTable(){
                console.log(usersOnline);
                $('#online-user').children("tr").remove();
                usersOnline.forEach( item=>{
                    var newRow = $("<tr class='border-b dark:border-neutral-500'>");
                    newRow.append("<td сlass='whitespace-nowrap px-6 py-4 font-medium'>"+ item.id +"</td>");
                    newRow.append("<td сlass='whitespace-nowrap px-6 py-4 font-medium'>"+ item.name +"</td>");
                    newRow.append("<td сlass='whitespace-nowrap px-6 py-4 font-medium text-green'>Онлайн</td>");
                    newRow.append("<td сlass='whitespace-nowrap px-6 py-4 font-medium text-green></td>").append(
                        "<a href=/admin/user-by-geo/" +item.id + ">На карте</a>"
                    );

                    $('#online-user').append(newRow);
                    }
                )
            }




        </script>
    @endpush
</x-app-layout>
