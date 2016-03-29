<!-- jQuery 2.2.0 -->
<script src="{{theme_url('plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="{{theme_url('js/bootstrap.min.js')}}"></script>

{{--Pace--}}
<script src="{{theme_url('plugins/pace/pace.min.js')}}"></script>

<!-- Morris.js charts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
{{--<script src="{{theme_url('plugins/morris/morris.min.js')}}"></script>--}}

<!-- Sparkline -->
{{--<script src="plugins/sparkline/jquery.sparkline.min.js"></script>--}}

<!-- jvectormap -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}

<!-- jQuery Knob Chart -->
{{--<script src="plugins/knob/jquery.knob.js"></script>--}}

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="{{theme_url('plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- datepicker -->
<script src="{{theme_url('plugins/datepicker/bootstrap-datepicker.js')}}"></script>

<!-- Bootstrap WYSIHTML5 -->
{{--<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>--}}

<!-- Slimscroll -->
<script src="{{theme_url('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>

<!-- FastClick -->
<script src="{{theme_url('plugins/fastclick/fastclick.js')}}"></script>

<!-- Gritter -->
<script src="{{theme_url('plugins/gritter/js/jquery.gritter.min.js')}}"></script>

{{----}}
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{theme_url('js/app.min.js')}}"></script>
<script src="{{theme_url('js/common-utils.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
