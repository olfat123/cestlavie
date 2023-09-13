<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('layouts.partials.head')
<body class="@yield('body_class')">
{{--@include('layouts.partials.confirmation')--}}
@include('layouts.partials.alerts-wrapper')
{{--@include('layouts.partials.front.menu')--}}
@yield('content')
@include('layouts.admin.partials.footer')

@yield('modals')
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>
@yield('scripts')
</body>
</html>
