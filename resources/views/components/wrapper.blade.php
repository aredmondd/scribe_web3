<x-header /> 
@isset($css)
    <link rel="stylesheet" href="{{ $css }}">
@endisset
<body>
    <x-navbar />

    {{ $slot }}

    <x-footer />
</body>
</html>