<x-app-layout>
    @push('css')
        <x-leaflet-styles/>
        <style>
            #map {
                min-height: 600px;
            }
            .collapse{
                visibility: visible;
            }
        </style>
    @endpush
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Все деревья
            </h2>
        </x-slot>
        <div class="container mx-auto py-3">
            <div class="row">
                <div class="col-md-9 relative mb-4">
                    <div id='map'></div>
                </div>
                <div class="col-md-3 relative mb-4">
                    <livewire:sidebar-filter></livewire:sidebar-filter>
                </div>
            </div>
        </div>

@push("js")
    <script>
        prepareSelection();
        function prepareSelection(){
            try {
                const selectIds = ["#categoriesSelection","#breedSelection","#typeSelection","#eventSelection","#statusSelection","#sanitarySelection"]
                selectIds.forEach((idItem)=>{
                   $(idItem).select2();
                });
            }
            catch (e) {
                console.log(e);
            }
        }
    </script>

@endpush
</x-app-layout>
