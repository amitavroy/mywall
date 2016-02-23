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

        <div class="col-lg-7 col-md-7 col-sm-12">
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
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add new permission</h3>
                </div>

                {{--form starts--}}
                <form action="{{ route('permission.save') }}" method="POST" class="form-horizontal"
                      id="create-permission">
                    <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="name"
                                       id="name" placeholder="Enter permission machine name"
                                       class="form-control" value="{{old('name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-3 control-label">Display Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="display_name"
                                       id="display_name" placeholder="Enter permission display name"
                                       class="form-control" value="{{old('display_name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                                <input type="text" name="description"
                                       id="description" placeholder="Enter permission description"
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
    {!! JsValidator::formRequest('App\Http\Requests\CreateRoleRequest', '#create-permission') !!}
@endsection

@section('scripts-footer')
@endsection
