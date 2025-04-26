@extends("layouts.front.front-layout")

@section("main")
    @admin
    <!-- Carousel Start -->
    <div class="container-fluid mx-auto">
        <livewire:home.heatmap/>
    </div>
    @endadmin
    @mayor
    <div class="container-fluid mx-auto">
        <livewire:home.heatmap/>
    </div>
    @endmayor
@endsection

