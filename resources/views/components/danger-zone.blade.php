<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="danger-divider mb-3">
    </div>
    <div class="row justify-content-between">
      <div class="col-8">
        <strong>Delete this {{ $entity }}</strong>
        <p>Once you delete this workshop, there is no going back. Please be certain.</p>
      </div>
      <div class="col">
        <button
          class="float-right btn btn-danger"
          data-toggle="modal"
          data-target="#{{ $entity }}DeleteModal"
        >Delete {{ $entity }}</button>
      </div>
    </div>
  </div>
</div>
