<div class="modal fade" id="changeEmailModal" tabindex="-1" role="dialog" aria-labelledby="changeEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Change your email address
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="/changeEmail">
          @csrf

          <div class="form-group">
            <label for="email" class="col-md-4 control-label">New Email Address</label>
            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Change Email Address
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
