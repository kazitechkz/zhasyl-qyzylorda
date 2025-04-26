<li class="{{request()->routeIs($route) ? 'bg-cyan-950': ''}}">
    <a class="nav-link" href="{{route($route)}}">
        <i class="{{$icon}}" aria-hidden="true"></i>
        <span>{{$routeName}}</span>
        @if($count != '' && $count != 0)
            <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
            {{$count}}
        </span>
        @endif
    </a>
</li>
