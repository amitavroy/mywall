<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List of Users</h3>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="user-listing">
                    <tbody>
                        <tr>
                            <th>#id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Member Since</th>
                            <th></th>
                        </tr>
                        @if(isset($users))
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                    <span class="role-name">{{ucfirst($role->name)}}</span>
                                    @endforeach
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a href="{{route('user.edit', $user->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="box-footer">
                @if(isset($users))
                    {{$users->render()}}
                @endif
            </div>
        </div>
    </div>
</div>
