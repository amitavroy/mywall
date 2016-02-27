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

        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Roles</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <th>Name</th>
                        @foreach ($roles as $role)
                            <th class="text-center">{{ $role->display_name }}</th>
                        @endforeach
                        </thead>

                        <form action="{{route('permission.matrix.save')}}" method="post">
                            {{csrf_field()}}
                            <tbody>
                            <button class="btn btn-success pull-right">
                                <i class="fa fa-save"></i> Save
                            </button>
                            @if (count($permissions))
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->display_name ?: $permission->name }}</td>

                                        @foreach ($roles as $role)
                                            <td class="text-center">
                                                <div class="checkbox icheck">
                                                    {{--{!! Form::checkbox("roles[{$role->id}][]", $permission->id, $role->hasPermission($permission->name)) !!}--}}
                                                    <label>
                                                        <input type="checkbox"
                                                               name="roles[{{$role->id}}][]"
                                                               value="{{$permission->id}}"
                                                            {{($role->hasPermission($permission->name)) ? 'checked' : ''}}
                                                            {{($role->id == 1) ? 'disabled' : ''}}>
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach

                                        <td class="text-center">
                                            Edit
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"><em>No records found.</em></td>
                                </tr>
                            @endif
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-footer')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
//            $('input').iCheck({
//                checkboxClass: 'icheckbox_square-blue',
//                radioClass: 'iradio_square-blue',
//                increaseArea: '20%' // optional
//            });
        });
    </script>
@endsection
