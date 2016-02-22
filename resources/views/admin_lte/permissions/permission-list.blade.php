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

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Permissions</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Display name</th>
                            <th>System name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->display_name}}</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->description}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-footer')
@endsection
