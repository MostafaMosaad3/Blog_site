<!DOCTYPE html>
<html lang="en">
<head>
    @include('website.layouts.head')
</head>
<body>
<!-- Responsive navbar-->
@include('website.layouts.navbar')
<div class="container m-3">
@include('dashboard.layouts.notifications')
<!-- Page content-->
@yield('content')
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('website_assets/js/scripts.js')}}"></script>
</body>
</html>
