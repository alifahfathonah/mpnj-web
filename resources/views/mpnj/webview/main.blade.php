<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/mpnj/images/logomp.jpg') }}" type="image/x-icon">

    <head>
        <title>@yield('title')</title>
    </head>

<body>

    {{-- Includes CSS --}}
    @include('mpnj.webview.style')

    {{-- Includes  Header --}}

    {{-- Isi Content --}}
    @yield('content')

    {{-- Includes  Footer --}}

    {{-- Includes JS --}}
    @include('mpnj.webview.script')

    {{--Includes JQuery--}}
    @stack('scripts')

</body>

</html>