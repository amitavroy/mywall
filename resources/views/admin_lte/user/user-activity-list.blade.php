@extends(settings('theme_folder') . 'master')

@section('page-title', 'My Activities')


    @section('page-header')
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Activities
            <small>View your activities in the system.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Activities</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <a href="{{route('profile')}}">
                            <i class="fa fa-info"></i> Details
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="{{route('activity-log')}}">
                            <i class="fa fa-history"></i> Activity log
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{route('user.change-password')}}">
                            <i class="fa fa-key"></i> Change password
                        </a>
                    </li>
                </ul>

                @include('admin_lte.user.partials.user-activity-list')

            </div>
        </div>
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
@endsection
