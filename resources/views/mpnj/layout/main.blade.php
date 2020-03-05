<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="{{ url('assets/mpnj/images/nj.png') }}" type="image/x-icon">
<head>
    <title>@yield('title')</title>
</head>
<body>

    {{-- Includes CSS --}}
    @include('mpnj.layout.style')   

    {{-- Includes  Header --}}
    @include('mpnj.layout.header')

    {{-- Isi Content --}}
    @yield('content')
    
    {{-- Includes  Footer --}}
    @include('mpnj.layout.footer')

    {{-- Includes JS --}}
    @include('mpnj.layout.script')


    @stack('scripts')

</body>
</html>
