@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 36rem;">
  <div class="row">
    <h1 class="col mb-4">Workshop info</h1>
  </div>

  <div class="row">
    <div class="col">
    @component('workshops.components.workshop')
      @slot('canEdit'){{ "true" }}@endslot
      @slot('title'){{ $workshop->title }}@endslot
      @slot('id'){{ $workshop->id }}@endslot
      @slot('description'){{ $workshop->description }}@endslot
      @slot('isParticipating')
        {{ $workshop->users()->get()->contains(Auth::user()) ? 'true' : 'false' }}
      @endslot
    @endcomponent
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      Owner: {{ $workshop->owner->name }}
    </div>
  </div>

  <div class="row justify-content-between danger-divider pt-4">
    <div class="col-8">
      <strong>Delete this workshop</strong>
      <p>Once you delete this workshop, there is no going back. Please be certain.</p>
    </div>
    <div class="col">
      <button
        class="float-right btn btn-danger"
        data-toggle="modal"
        data-target="#workshopDeleteModal"
      >Delete workshop</button>
    </div>
  </div>
</div>

<div class="modal fade" id="workshopDeleteModal" tabindex="-1" role="dialog" aria-labelledby="workshopDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Are you sure? This cannot be undone!
      </div>
      <div class="modal-footer">
        <button class="float-left btn btn-secondary mr-3" data-dismiss="modal" aria-label="Close">No, take me back!</button>
        <form method="POST" action="/workshops/{{ $workshop->id }}">
          @csrf
          @method("DELETE")
          <button class="float-right btn btn-danger" onclick="this.form.submit()">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

