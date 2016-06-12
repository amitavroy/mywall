@extends(settings('theme_folder') . 'master')

@section('page-title', 'Manage Roles')

@section('page-header')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Roles
        <small>Role and Permission management</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Roles</li>
    </ol>
</section>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Roles</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover table-striped table-bordered" id="role-listing">
                        <tbody>
                        <tr class="info">
                            <th>#</th>
                            <th>Display name</th>
                            <th>System name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>

                        @foreach($roles->sortBy('name') as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->display_name}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->description}}</td>
                                <td class="col-sm-2">
                                    <a href="javascript:;" class="btn btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if($role->id != 1 && $role->id != 2)
                                    <a href="{{route('role.delete', $role->id)}}" class="btn btn-warning">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add new Role</h3>
                </div>

                {{--form starts--}}
                <form action="{{ route('role.save') }}" method="POST" class="form-horizontal" id="create-role">
                    <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="name"
                                       id="name" placeholder="Enter role machine name"
                                       class="form-control" value="{{old('name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-3 control-label">Display Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="display_name"
                                       id="display_name" placeholder="Enter role display name"
                                       class="form-control" value="{{old('display_name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                                <input type="text" name="description"
                                       id="description" placeholder="Enter role description"
                                       class="form-control" value="{{old('description')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
                {{--form ends--}}
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {!! JsValidator::formRequest('\App\Wall\Http\Request\Role\CreateRoleRequest', '#create-role') !!}
    @endsection

    @section('scripts-footer')
        <!-- AdminLTE for demo purposes -->
    <script src="{{theme_url('js/demo.js')}}"></script>
    <script src="{{theme_url('js/pages/roles.js')}}"></script>
    <script>
        $(document).ready(function () {
            Roles.init();
        });
    </script>
@endsection
