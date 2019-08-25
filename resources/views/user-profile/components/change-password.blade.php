<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Change your password
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="/changePassword">
          @csrf
          <div class="form-group">
            <label for="current_password" class="col-md-4 control-label">Current Password</label>
            <div class="col-md-6">
              <input id="current_password" type="password" class="form-control" name="current_password" required>
            </div>
          </div>

          <div class="form-group">
            <label for="new_password" class="col-md-4 control-label">New Password</label>
            <div class="col-md-6">
              <input id="new_password" type="password" class="form-control" name="new_password" required>
            </div>
          </div>

          <div class="form-group">
            <label for="new_password-confirm" class="col-md-4 control-label">Confirm New Password</label>
            <div class="col-md-6">
              <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Change Password
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
