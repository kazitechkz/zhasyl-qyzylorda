<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="text-right" action="{{route("update-marker-by-place")}}" method="post">
                    @csrf
                    <button class="btn btn-success bg-success my-3" type="submit">Актуализировать посадки по районам</button>
                </form>
            </div>
        </div>
    </div>


    <livewire:admin.convert/>
</x-app-layout>

