@extends(settings('theme_folder') . 'master')

@section('page-title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{theme_url('plugins/croppie/croppie.css')}}">
    @endsection

    @section('page-header')
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
            <small>Manage your profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#details" aria-controls="details" role="tab"
                           data-toggle="tab">
                            <i class="fa fa-info"></i> Details
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#activity-log" aria-controls="activity-log" role="tab" data-toggle="tab">
                            <i class="fa fa-history"></i> Activity log
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                            <i class="fa fa-gear"></i> Settings
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="details">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="box box-solid">
                                    <div class="box-header with-border"><h4 class="box-title">User details</h4></div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                   value="{{$user->email}}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Display name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input type="text" name="first_name" id="first_name"
                                                   class="form-control" value="{{$user->first_name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control"
                                                   value="{{$user->last_name}}">
                                        </div>

                                        <button class="btn btn-success" id="save-profile">
                                            <i class="fa fa-save"></i>
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="box box-solid">
                                    <div class="box-header with-border"><h4 class="box-title">Avatar</h4></div>
                                    <div class="box-body">
                                        <input type="hidden" id="imagebase64" name="imagebase64">

                                        <div id="result-ad">
                                            <div id="result-ad-img"><img src="{{Auth::user()->present()->avatar}}"
                                                                         alt=""></div>
                                        </div>

                                        <div class="form-group">
                                            <p align="center">
                                                <button type="button"
                                                        class="btn btn-info"
                                                        id="croppie-modal"
                                                        data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-upload"></i>
                                                    Upload Ad Image
                                                </button>

                                                <button class="btn btn-primary">
                                                    <i class="fa fa-save"></i>
                                                    Save
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="activity-log">
                        <h2>Activity log</h2>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">
                        <h2>Settings</h2>
                    </div>
                </div>

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
    <script src="{{theme_url('plugins/croppie/croppie.min.js')}}"></script>
    <script src="{{url('modules/croppie.js')}}"></script>
    <script>
        $(document).ready(function () {
            /*setting the croppie instance*/
            cropAdImage.init({
                container: '#upload-demo',
                inputField: '#upload',
                hiddenInputField: '#imagebase64',
                button: '.upload-result',
                resultContainer: '#result-ad #result-ad-img',
                width: 200,
                height: 200
            });

            $('#save-profile').on('click', function () {
                $('#save-profile i').removeClass().addClass('fa fa-refresh fa-spin');
                editProfile.updateDetails();
                return false;
            });
        });

        var editProfile = (function () {
            /**
             * Saving the user profile details on save button
             */
            var updateUserDetails = function () {
                var postData = {
                    first_name: $('input[name="first_name"]').val(),
                    last_name: $('input[name="last_name"]').val(),
                    name: $('input[name="name"]').val()
                };

                $.ajax({
                    url: base_url + 'profile',
                    type: "POST",
                    dataType: "json",
                    data: postData
                }).success(function (response) {
                    $('#save-profile i').removeClass().addClass('fa fa-save');
                    $('.display-name').html(response.name);
                    $.gritter.add({
                        title: 'Action completed',
                        text: 'Your profile is saved',
                        time: '',
                        class_name: 'my-sticky-class'
                    });
                }).error(function () {
                    
                });
            };

            return {
                updateDetails: updateUserDetails
            }

        })();
    </script>
@endsection
