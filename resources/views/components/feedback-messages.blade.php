<div class="container">
  <div class="row justify-content-center">
    <!-- Custom success messages -->
    @if (session('success'))
      <div class="col-md-8">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    @endif

    <!-- Custom warning messages -->
    @if (session('warning'))
      <div class="col-md-8">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('warning') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    @endif

    <!-- Error messages -->
    @if ($errors->any())
      <div class="col-md-8">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    @endif
  </div>
</div>
