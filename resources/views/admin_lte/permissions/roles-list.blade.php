@extends(settings('theme_folder') . 'master')

@section('page-title', 'Dashboard')

@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
@endsection

@section('content')

@endsection

@section('scripts-footer')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{theme_url('js/pages/dashboard.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{theme_url('js/demo.js')}}"></script>
@endsection
