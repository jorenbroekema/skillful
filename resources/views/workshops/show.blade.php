@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h1 class="col-md-8">Workshop info</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
    @component('workshops.components.workshop')
      @slot('canEdit'){{ "true" }}@endslot
      @slot('title'){{ $workshop->title }}@endslot
      @slot('id'){{ $workshop->id }}@endslot
      @slot('owner'){{ $workshop->owner->name }}@endslot
      @slot('description'){{ $workshop->description }}@endslot
      @slot('difficulty'){{ $workshop->difficulty }}@endslot
      @slot('start_date'){{ $workshop->start_date }}@endslot
      @slot('end_date'){{ $workshop->end_date }}@endslot
      @slot('isParticipating')
        {{ $workshop->users()->get()->contains(Auth::user()) ? 'true' : 'false' }}
      @endslot
    @endcomponent
    </div>
  </div>
  <div class="row justify-content-center mb-4">
    <div class="col-md-8">
      Owner: {{ $workshop->owner->name }}
    </div>
  </div>
  @component('components.danger-zone')
    @slot('entity'){{ 'workshop' }}@endslot
  @endcomponent
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

