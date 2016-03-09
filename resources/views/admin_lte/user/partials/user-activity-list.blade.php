<div role="tabpanel" class="tab-pane" id="settings">
    <div class="box box-solid">
        <div class="box-header with-border"><h4 class="box-title">My Activities</h4></div>
        <div class="box-body">
            <table class="table-bordered table-hover table-striped table table-responsive">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Event time</th>
                    <th>User agent</th>
                </tr>

                @foreach($activities as $activity)
                    <tr>
                        <td>{{$activity->id}}</td>
                        <td>{{$activity->description}}</td>
                        <td><a href="#">{{$activity->name}}</a></td>
                        <td>{{$activity->ip_address}}</td>
                        <td>{{$activity->created_at}}</td>
                        <td>{{$activity->user_agent}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $activities->render()  !!}
        </div>
    </div>
</div>
