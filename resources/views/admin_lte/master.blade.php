<!DOCTYPE html>
<html>
<head>
    @include(settings('theme_folder') . 'sections.meta-data')

    @include(settings('theme_folder') . 'sections.style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include(settings('theme_folder') . 'sections.header')

        <!-- Left side column. contains the logo and sidebar -->
    @include(settings('theme_folder') . 'sections.sidebar')

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('page-header')

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin_lte.sections.footer')

    @include('admin_lte.sections.control-sidebar')

    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('admin_lte.sections.footer-scripts')
</body>
</html>
