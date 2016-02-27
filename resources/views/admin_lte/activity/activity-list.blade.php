@extends(settings('theme_folder') . 'master')

@section('page-title', 'Manage Permissions')

@section('page-header')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Permissions
        <small>Role and Permission management</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Permissions</li>
    </ol>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Activities</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Event time</th>
                            <th>User agent</th>
                            <th></th>
                        </tr>
                        @foreach($activities as $activity)
                            <tr>
                                <td>{{$activity->id}}</td>
                                <td>{{$activity->description}}</td>
                                <td>{{$activity->ip_address}}</td>
                                <td>{{$activity->created_at}}</td>
                                <td>{{$activity->user_agent}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {!! $activities->render()  !!}
        </div>
    </div>
@endsection

@section('scripts-footer')
@endsection
