<x-app-layout>
    @push('css')
    <x-leaflet-styles/>
    @endpush
    <div class="container mx-auto py-5">
        <form id="area-form" action="{{route('private-policy.store')}}" method="post">
            @csrf
            <div class="my-2">
                <label>На казахском</label>
                <textarea name="text_kk"></textarea>
            </div>
            <div class="my-2">
                <label>На русском</label>
                <textarea name="text_ru"></textarea>
            </div>
            <button
                id="submit-map"
                type="submit"
                class="my-3 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Сохранить
            </button>
        </form>

    </div>

    @push('js')
            <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('text_kk');
                CKEDITOR.replace('text_ru');
            </script>
    @endpush
</x-app-layout>
