<!--   Core JS Files   -->

<script src="{{URL::asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{URL::asset('/assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
<script src="{{URL::asset('/assets/js/plugins/plugins-jquery.js')}}"></script>
<script src="{{URL::asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('/assets/js/plugins/choices.min.js')}}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- GitHub buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{URL::asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
@yield('js')
