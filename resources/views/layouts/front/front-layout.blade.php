<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    @livewireStyles
    <x-front-layout-styles></x-front-layout-styles>
    @stack('front_css')
</head>

<body>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-dark text-light px-0 py-2">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <span>{{__('messages.head_message')}}</span>
            </div>

        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <span class="fa fa-phone-alt me-2"></span>
                <span>+7(7252) 53-65-49</span>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <span class="far fa-envelope me-2"></span>
                <span>prirodab@mail.ru</span>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0"><span class="text-success">ZHASYL</span> <span class="text-danger">Shymkent</span></h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">{{__('messages.main')}}</a>
            <a href="{{route("front-map")}}" class="nav-item nav-link">{{__('messages.map')}}</a>
            @if(auth()->check())
            @admin
            <a href="{{route("front-heatmap")}}" class="nav-item nav-link">{{__('messages.hot_map')}}</a>
            @endadmin
            @mayor
            <a href="{{route("front-heatmap")}}" class="nav-item nav-link">{{__('messages.hot_map')}}</a>
            @endmayor
            @endif
{{--            <a href="{{route("faq")}}" class="nav-item nav-link">FAQ</a>--}}
            <a href="{{route("contact")}}" class="nav-item nav-link">{{__('messages.contact')}}</a>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if(LaravelLocalization::getCurrentLocale() == 'ru')
                        <span class="nav-profile-name">Русский</span>
                    @elseif(LaravelLocalization::getCurrentLocale() == 'kk')
                        <span class="nav-profile-name">Қазақша</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <i class="mdi mdi-earth text-primary"></i>
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </li>
        </div>
        @if(auth()->check())
            @admin
            <a href="{{route("admin-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endadmin
            @moder
            <a href="{{route("moder-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endmoder
            @mayor
            <a href="{{route("mayor-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endmayor
            @agronom
            <a href="{{route("agronom-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endagronom
            @consumer
            <a href="{{route("consumer-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endconsumer
            @chef
            <a href="{{route("chef-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endchef
            @agronomist
            <a href="{{route("agronomist-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endagronomist
            @brigadier
            <a href="{{route("brigadier-dashboard")}}" class="btn btn-primary py-4 px-lg-4 rounded-0  d-block">{{__('messages.hello')}}, {{auth()->user()->name}}<i class="fa fa-arrow-right ms-3"></i></a>
            @endbrigadier
        @else
            <a href="{{route("login")}}" class="btn btn-primary py-4 px-lg-4 rounded-0 d-block">{{__('messages.login')}}<i class="fa fa-arrow-right ms-3"></i></a>
        @endif
    </div>
</nav>
<!-- Navbar End -->

@yield("main")


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 col-md-6">
                <h4 class="text-white mb-4">{{__('messages.contact')}}</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> 	г.Шымкент, Туркестанская, 11А </p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+7(7252) 53-65-49</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>prirodab@mail.ru</p>
{{--                <div class="d-flex pt-2">--}}
{{--                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>--}}
{{--                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>--}}
{{--                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>--}}
{{--                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-6 col-md-6">
                <h4 class="text-white mb-4">{{__('messages.links')}}</h4>
                <a class="btn btn-link" href="/">{{__('messages.main')}}</a>
                <a class="btn btn-link" href="{{route("front-map")}}">{{__('messages.map')}}</a>
                @if(auth()->check())
                    @admin
                    <a class="btn btn-link" href="{{route("front-heatmap")}}">{{__('messages.hot_map')}}</a>
                    @endadmin
                    @mayor
                    <a class="btn btn-link" href="{{route("front-heatmap")}}">{{__('messages.hot_map')}}</a>
                    @endmayor
                @endif
{{--                <a class="btn btn-link" href="{{route("faq")}}">Вопросы-Ответы</a>--}}
                <a class="btn btn-link" href="{{route("contact")}}">{{__('messages.contact')}}</a>
            </div>
{{--            <div class="col-lg-4 col-md-6">--}}
{{--                <h4 class="text-white mb-4">Рассылка</h4>--}}
{{--                <p>Присылать новости по почте:</p>--}}
{{--                <div class="position-relative w-100">--}}
{{--                    <input class="form-control bg-light border-light w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="javascript:void (0)">Zhasyl Shymkent</a> {{__('messages.privacy_message')}}.
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<x-front-layout-scripts></x-front-layout-scripts>
@livewireScripts
@stack('front_js')
</body>

</html>
