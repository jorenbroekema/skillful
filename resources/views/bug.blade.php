@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="/bug">
        @csrf
        <div class="form-group">
          <label for="bug-form__userName">Name (Optional)</label>
          <input
            id="bug-form__userName"
            class="form-control"
            type="text"
            name="name"
            placeholder="Your name"
            aria-describedby="bugUserNameHelp"
          >
        </div>
        <div class="form-group">
          <label for="bug-form__bugURL">Page URL</label>
          <input
            required
            id="bug-form__bugURL"
            class="form-control"
            type="text"
            name="url"
            placeholder="For example '/workshops'"
            aria-describedby="bugURLHelp"
          >
        </div>
        <div class="form-group">
          <label for="bug-form__bugDesc">Bug description</label>
          <textarea
            required
            id="bug-form__bugDesc"
            class="form-control"
            type="textarea"
            name="description"
            placeholder="Provide a description of what you expected, and the actual unexpected result you got."
            aria-describedby="bugDescHelp"
            rows="3"
          ></textarea>
        </div>
        <!-- Create file upload architecture on backend first -->
        <!--
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
              <label class="custom-file-label" for="inputGroupFile01">Choose files</label>
            </div>
          </div>
        </div>
        -->
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Send bug report</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
