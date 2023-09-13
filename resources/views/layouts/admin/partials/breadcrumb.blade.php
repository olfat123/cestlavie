<div id="top_bar">
    <ul id="breadcrumbs" class="uk-float-left">
        @isset($breadcrumb)
            @foreach($breadcrumb['pages'] as $page)
                <li><a href="{{ $page['route'] }}">{{$page['title']}}</a></li>
            @endforeach
            <li><span>{{$breadcrumb['current']}}</span></li>
        @endisset
    </ul>
    @yield('d-buttons')
    <div class="clearfix"></div>
</div>
