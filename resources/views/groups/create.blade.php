@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="/groups">
        @csrf
        <div class="form-group">
          <label for="group-form__groupName">Group Name</label>
          <input
            id="group-form__groupName"
            class="form-control"
            type="text"
            name="name"
            placeholder="Enter group name"
            aria-describedby="groupNameHelp"
          >
        </div>
        <div class="form-group">
          <label for="group-form__groupDesc">Group Description</label>
          <textarea
            id="group-form__groupDesc"
            class="form-control"
            type="textarea"
            name="description"
            placeholder="Enter group description"
            aria-describedby="groupDescHelp"
            rows="3"
          ></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Create Group</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
