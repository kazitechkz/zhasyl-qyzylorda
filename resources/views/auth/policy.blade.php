<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container w-full px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card">
            <div class="flex justify-between items-center">
                <div class="card-header text-black text-3xl my-3">
                    {{__('messages.private_policy_title')}}
                </div>
                <div class="flex">
                    <a hreflang="kk" href="{{ LaravelLocalization::getLocalizedURL('kk', null, [], true) }}" class="mx-2">KZ</a>
                    <a hreflang="ru" href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}" class="mx-2">RU</a>
                </div>
            </div>

            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    {!! $policy->text !!}
                </blockquote>
            </div>
        </div>
    </div>
</x-guest-layout>
