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
    <div class="row">

        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Users</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <tr>
                            <th>#id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Member Since</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
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
