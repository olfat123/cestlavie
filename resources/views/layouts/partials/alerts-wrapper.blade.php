@if (flash()->message)
    @php
        $str = \Illuminate\Support\Str::after(flash()->class, '-');
        $title = $str != 'danger' ? $str : 'error';
    @endphp
    <div class="uk-alert uk-alert-{{flash()->class}}" data-uk-alert="">
        <a href="#" class="uk-alert-close uk-close"></a>
        {{flash()->message}}
    </div>
    <script>
        $("div.uk-alert").delay(4000).fadeOut();
    </script>
@else
    <div class="uk-alert" data-uk-alert="">
        {{--<a class="uk-alert-close uk-close"></a>--}}
       <span></span>
    </div>
@endif
