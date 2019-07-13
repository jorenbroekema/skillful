@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="/feedback">
        @csrf
        <div class="form-group">
          <label for="feedback-form__userName">Name (Optional)</label>
          <input
            id="feedback-form__userName"
            class="form-control"
            type="text"
            name="name"
            placeholder="Your name"
            aria-describedby="feedbackUserNameHelp"
          >
        </div>
        <div class="form-group">
          <label for="feedback-form__feedbackDesc">Feedback</label>
          <textarea
            id="feedback-form__feedbackDesc"
            class="form-control"
            type="textarea"
            name="feedback"
            placeholder="Let us know what you think, good or bad!"
            aria-describedby="feedbackDescHelp"
            rows="3"
          ></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Send Feedback</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
