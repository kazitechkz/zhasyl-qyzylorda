<x-app-layout>
    <div class="container mx-auto py-5">
        <h1 class="mb-4 rounded-lg bg-secondary-100 px-6 py-5 text-base text-secondary-800">Редактировать породу</h1>
        <form action="{{route('breed.update', $breed->id)}}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="relative mb-4">
                <input
                    type="text"
                    class="@error('title_ru') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
                    name="title_ru"
                    value="{{$breed->title_ru}}"
                    placeholder="Наименование на рус" />
                @error('title_ru')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="text"
                    class="@error('title_kz') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
                    name="title_kz"
                    value="{{$breed->title_kz}}"
                    placeholder="Наименование на каз" />
                @error('title_kz')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="number"
                    class="@error('old_age') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
                    name="old_age"
                    value="{{$breed->old_age}}"
                    placeholder="Возраст для старого дерева" />
                @error('old_age')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label for="type_id" class="w-full">Выберите тип</label>
                <select name="type_id" class="w-full" id="type_id">
                    @if(count($types))
                        @foreach($types as $typeItem)
                            <option @if($typeItem->id == $breed->type_id) selected @endif value="{{$typeItem->id}}">
                                {{$typeItem->title_ru}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('type_id')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="text"
                    class="@error('coefficient') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
                    name="coefficient"
                    value="{{$breed->coefficient}}"
                    placeholder="Коэффициент для расчета" />
                @error('coefficient')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <input
                    type="file"
                    class="@error('image_url') border-red-600 @enderror peer block min-h-[auto] w-full rounded border-1"
                    name="image_url"
                    value="{{old('image_url')}}"
                    accept="image/png, image/jpeg"
                    placeholder="Изображение" />
                @error('image_url')
                <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <button
                type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                Обновить
            </button>
        </form>

    </div>
</x-app-layout>

