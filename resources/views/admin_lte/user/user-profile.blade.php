@extends(settings('theme_folder') . 'master')

@section('page-title', 'My profile')

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
                        <a href="{{route('profile')}}">
                            <i class="fa fa-info"></i> Details
                        </a>
                    </li>
                    <li role="presentation">
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

                <!-- Tab panes -->
                <div class="tab-content">
                    @include('admin_lte.user.partials.user-details')
                    {{--@include('admin_lte.user.partials.user-settings')--}}
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

            /*Handle the click of profile update button*/
            $('#save-profile').on('click', function () {
                $('#save-profile i').removeClass().addClass('fa fa-refresh fa-spin');
                editProfile.updateDetails();
                return false;
            });

            /**/
            $('#save-avatar').on('click', function () {
                $('#save-avatar i').removeClass().addClass('fa fa-refresh fa-spin');
                editProfile.saveUserAvatar();
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
                    $('#save-profile i').removeClass().addClass('fa fa-save');
                });
            };

            /**
             * Save the user avatar
             */
            var saveUserAvatar = function () {
                var postData = {
                    avatar: $('input[name="imagebase64"]').val()
                };

                $.ajax({
                    url: base_url + 'avatar-save',
                    type: "POST",
                    dataType: "json",
                    data: postData
                }).success(function (response) {
                    $('#save-avatar i').removeClass().addClass('fa fa-save');
                    $('img.user-pic').attr('src', response.data.image_url);
                    $.gritter.add({
                        title: 'Action completed',
                        text: 'Your profile is changed.',
                        time: '',
                        image: response.data.image_url,
                        class_name: 'my-sticky-class'
                    });
                }).error(function () {
                    $('#save-avatar i').removeClass().addClass('fa fa-save');
                });
            };

            return {
                updateDetails: updateUserDetails,
                saveUserAvatar: saveUserAvatar
            }

        })();
    </script>
@endsection
