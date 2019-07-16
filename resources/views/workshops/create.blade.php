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
        @if (auth()->user() && auth()->user()->groups->count() > 0)
          <div class="form-group">
            <label for="workshop-form__workshopGroup">Workshop group</label>
            <select
              id="workshop-form__workshopGroup"
              class="form-control"
              type="textarea"
              name="group"
              placeholder="Enter workshop group"
              aria-describedby="workshopGroupHelp"
            >
              @foreach (auth()->user()->groups as $group)
                <!-- TODO: if create workshop was selected from group view, put that group as the first option -->
                <option value="{{ $group->id }}">{{ $group->name }}</option>
              @endforeach
            </select>
          </div>
        @endif
        <div class="form-check mb-3">
          <input
            type="checkbox"
            class="form-check-input"
            id="workshop-form__workshopPublic"
            name="public"
            @if (auth()->user() && auth()->user()->groups->count() === 0)
              checked disabled
            @endif
          >
          <!-- TODO: Add tippy with extra info. Also make extra info for when it is disabled, to explain why "you are not in any group, so you can only make public workshops" -->
          <label class="form-check-label" for="workshop-form__workshopPublic">Public (everyone can view and request to join this workshop)</label>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Create Workshop</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
