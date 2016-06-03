@extends(settings('theme_folder') . 'master')

@section('page-title', 'User list')

@section('page-header')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add new User
        <small>Fill up the details and create a new user.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('user.list')}}"><i class="fa fa-dashboard"></i> User list</a></li>
        <li class="active">Add User</li>
    </ol>
</section>
@endsection

@section('content')
    <div class="row">
        <form action="{{route('user.save')}}" method="post" id="save-user" class="form-horizontal">
            <div class="col-sm-6 col-sm-push-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new User</h3>
                    </div>

                    <div class="box-body">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="name"
                                       id="name" placeholder="Enter user display name"
                                       class="form-control" value="{{old('name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="text" name="email"
                                       id="email" placeholder="Enter user's uniue email address"
                                       class="form-control" value="{{old('email')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">First name</label>

                            <div class="col-sm-9">
                                <input type="text" name="first_name"
                                       id="first_name" placeholder="Enter user's first name"
                                       class="form-control" value="{{old('first_name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Last name</label>

                            <div class="col-sm-9">
                                <input type="text" name="last_name"
                                       id="last_name" placeholder="Enter user's last name"
                                       class="form-control" value="{{old('last_name')}}"/>
                            </div>
                        </div>

                        @if (settings('send_password_through_mail') == false)
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-9">
                                    <input type="password" name="password"
                                           id="password" placeholder="Enter user password"
                                           class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Confirm password</label>

                                <div class="col-sm-9">
                                    <input type="password" name="cpassword"
                                           id="cpassword" placeholder="Confirm user password"
                                           class="form-control"/>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Roles</label>

                            <div class="col-sm-9">
                                @foreach($roles as $role)
                                    {{--Should not show role 2. All users are authenticated users by default--}}
                                    @if ($role->id != 2)
                                        <div class="checkbox icheck">
                                            <label class="col-sm-9">
                                                <input type="checkbox"
                                                       name="role[{{$role->id}}]"> {{$role->display_name}}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success">
                    <i class="fa fa-save"></i> Save user
                </button>
            </div>
        </form>

    </div> <!-- end row -->
@endsection

@section('scripts-footer')
    {!! JsValidator::formRequest('\App\Wall\Http\Request\User\CreateUserRequest', '#save-user') !!}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
