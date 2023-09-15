


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('layouts.head')
</head>

<body class="g-sidenav-show rtl bg-gray-100">
@include('layouts.main-sidebar')
@include('layouts.main-header')


<div class="container-fluid py-4">
    @yield('content')

    @include('layouts.footer')
</div>
</main>
@include('layouts.fixed-plugin-button')
@include('layouts.footer-script')


</body>

</html>
