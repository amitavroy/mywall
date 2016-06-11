@extends(settings('theme_folder') . 'master')

@section('page-title', 'User list')

@section('page-header')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User list
        <small>List of users registered currently to the system.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User list</li>
    </ol>
</section>
@endsection

@section('content')
    @include(settings('theme_folder') . 'compose_views/compose-user-listing')
@endsection

@section('scripts-footer')
@endsection
