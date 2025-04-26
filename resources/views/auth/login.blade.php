<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center">
                <label for="file" class="w-[50px]">
                    <img src="{{asset('images/key.svg')}}" alt="">
                </label>
                <input id="file" class="w-full mt-1" type="file" name="file" accept=".pfx"/>
            </div>
            <x-input-error :messages="$errors->get('file')" class="mt-2" />
            <div class="flex my-3 items-center">
                <input type="checkbox" id="check" name="check">
                <label for="check" class="ml-3 text-white">Я согласен с <a href="{{route('private-policy')}}" class="text-blue-200" target="_blank">условиями</a></label>
            </div>
            <x-input-error :messages="$errors->get('check')" class="mt-2" />
            <!-- Email Address -->
            {{--        <div>--}}
            {{--            <x-input-label for="email" :value="__('Email')" />--}}
            {{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
            {{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
            {{--        </div>--}}

            <!-- Password -->
            {{--        <div class="mt-4">--}}
            {{--            <x-input-label for="password" :value="__('Пароль')" />--}}

            {{--            <x-text-input id="password" class="block mt-1 w-full"--}}
            {{--                            type="password"--}}
            {{--                            name="password"--}}
            {{--                            required autocomplete="current-password" />--}}

            {{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
            {{--        </div>--}}

            <!-- Remember Me -->
            {{--        <div class="block mt-4">--}}
            {{--            <label for="remember_me" class="inline-flex items-center">--}}
            {{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
            {{--                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Запомни меня') }}</span>--}}
            {{--            </label>--}}
            {{--        </div>--}}

            <div class="flex items-center justify-end mt-4">
                {{--@if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif--}}

                <x-primary-button class="w-full justify-center">
                    {{ __('Вход') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
