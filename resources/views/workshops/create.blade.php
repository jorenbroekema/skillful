@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="/workshops">
        @csrf
        <div class="form-group">
          <label for="workshop-form__workshopTitle">Workshop Title</label>
          <input
            id="workshop-form__workshopTitle"
            class="form-control"
            type="text"
            name="title"
            placeholder="Enter workshop title"
            aria-describedby="workshopTitleHelp"
          >
        </div>
        <div class="form-group">
          <label for="workshop-form__workshopDesc">Workshop Description</label>
          <textarea
            id="workshop-form__workshopDesc"
            class="form-control"
            type="textarea"
            name="description"
            placeholder="Enter workshop description"
            aria-describedby="workshopDescHelp"
            rows="3"
          ></textarea>
        </div>
        <div class="form-group">
          <label for="workshop-form__workshopDiff">Workshop Difficulty</label>
          <select
            id="workshop-form__workshopDiff"
            class="form-control"
            type="textarea"
            name="difficulty"
            placeholder="Enter workshop difficulty"
            aria-describedby="workshopDiffHelp"
          >
            <option value=""></option>
            <option value="1">Novice</option>
            <option value="2">Intermediate</option>
            <option value="3">Advanced</option>
          </select>
        </div>
        <div class="form-group">
          <label for="workshop-form__workshopDesc">Start Date</label>
          <input
            id="workshop-form__workshopStart"
            class="form-control"
            type="datetime-local"
            name="start_date"
            placeholder="Enter start date"
            aria-describedby="workshopStartHelp"
          />
        </div>
        <div class="form-group">
          <label for="workshop-form__workshopDesc">End Date</label>
          <input
            id="workshop-form__workshopEnd"
            class="form-control"
            type="datetime-local"
            name="end_date"
            placeholder="Enter end date"
            aria-describedby="workshopEndHelp"
          />
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Create Workshop</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
