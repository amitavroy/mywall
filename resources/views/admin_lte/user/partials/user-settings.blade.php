<div role="tabpanel" class="tab-pane" id="settings">
    <form action="{{route('user.save-new-password')}}" id="change-password-form" method="POST">
        {{csrf_field()}}
        <div class="box box-solid">
            <div class="box-header with-border"><h4 class="box-title">Change password</h4></div>
            <div class="box-body">

                <div class="form-group">
                    <label for="email">Current password</label>
                    <input type="password" name="current_password"
                           id="current_password" class="form-control" tabindex="1"
                           placeholder="Enter your current password">
                </div>

                <div class="form-group">
                    <label for="email">New password</label>
                    <input type="password" name="new_password"
                           id="new_password" class="form-control" tabindex="2"
                           placeholder="Enter your new password">
                </div>

                <div class="form-group">
                    <label for="email">Confirm password</label>
                    <input type="password" name="confirm_password"
                           id="confirm_password" class="form-control" tabindex="3"
                           placeholder="Confirm your new password">
                </div>

                <button class="btn btn-success" id="save-profile">
                    <i class="fa fa-save"></i>
                    Save changes
                </button>
            </div>
        </div>
    </form>
</div>
