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
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{$user->name}}">
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
                        <div id="result-ad-img">
                            <img src="{{Auth::user()->present()->avatar}}" alt="">
                        </div>
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

                            <button class="btn btn-primary" id="save-avatar">
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
