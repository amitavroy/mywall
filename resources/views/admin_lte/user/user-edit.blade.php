@extends(settings('theme_folder') . 'master')

@section('page-title', 'Edit user')

@section('page-header')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit user
        <small>Edit user details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
</section>
@endsection

@section('content')
    <div class="row">
        <form action="{{route('user.update')}}" method="post" id="edit-user" class="form-horizontal">
            <div class="col-md-6 col-md-push-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new User</h3>
                    </div>

                    <div class="box-body">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{$user->id}}">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="name"
                                       id="name" placeholder="Enter user display name"
                                       class="form-control" value="{{$user->name}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="text"
                                       id="email" placeholder="Enter user's uniue email address"
                                       class="form-control" value="{{$user->email}}" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">First name</label>

                            <div class="col-sm-9">
                                <input type="text" name="first_name"
                                       id="first_name" placeholder="Enter user's first name"
                                       class="form-control" value="{{$user->first_name}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Last name</label>

                            <div class="col-sm-9">
                                <input type="text" name="last_name"
                                       id="last_name" placeholder="Enter user's last name"
                                       class="form-control" value="{{$user->last_name}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Roles</label>

                            <div class="col-sm-9">
                                @foreach($roles as $role)
                                    <div class="checkbox icheck">
                                        <label class="col-sm-9">
                                            <input type="checkbox" name="role[{{$role->id}}]"
                                                {{($user->hasRole($role->name)) ? 'checked' : ''}}
                                                {{($user->id == 1 && $role->id == 1) ? 'disabled' : ''}}> {{$role->display_name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success"><i class="fa fa-save"></i> Save user</button>
            </div>
        </form>
    </div>

    {{--Modal start--}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Ad image</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" id="upload" value="Choose a file">
                    </div>
                    <div id="upload-demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default upload-result"
                            data-dismiss="modal">Update & Close
                    </button>
                </div>
            </div>

        </div>
    </div>
    {{--modal ends--}}
@endsection

@section('scripts-footer')
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
