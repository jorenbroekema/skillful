@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 36rem;">
  <div class="row">
    <h1 class="col mb-4">Group info</h1>
  </div>

  <div class="row">
    <div class="col">
    @component('groups.components.group')
      @slot('canEdit'){{ "false" }}@endslot
      @if ($group->owner->id === Auth::id())
        @slot('canEdit'){{ "true" }}@endslot
      @endif
      @slot('canJoin'){{ "true" }}@endslot
      @foreach($group->members as $member)
        @if ($member->id === Auth::id())
          @slot('canJoin'){{ "false" }}@endslot
        @endif
      @endforeach
      @slot('name'){{ $group->name }}@endslot
      @slot('id'){{ $group->id }}@endslot
      @slot('description'){{ $group->description }}@endslot
    @endcomponent
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      Owner: {{ $group->owner->name }}
    </div>
  </div>
  @foreach($group->members as $member)
    @if ($member->id === Auth::id() && $group->owner->id !== Auth::id())
      <div class="row mb-4">
        <div class="col">
          <form method="POST" action="/members/{{ Auth::id() }}">
            @method('DELETE')
            @csrf
            <input type="hidden" name="group" value="{{ $group->id }}">
            <button class="btn btn-danger" onclick="this.form.submit()">Leave</button>
          </form>
        </div>
      </div>
    @endif
  @endforeach


  <div class="row justify-content-between danger-divider pt-4">
    <div class="col-8">
      <strong>Delete this group</strong>
      <p>Once you delete this group, there is no going back. Please be certain.</p>
    </div>
    <div class="col">
      <button
        class="float-right btn btn-danger"
        data-toggle="modal"
        data-target="#groupDeleteModal"
      >Delete group</button>
    </div>
  </div>
</div>

<div class="modal fade" id="groupDeleteModal" tabindex="-1" role="dialog" aria-labelledby="groupDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Are you sure? This cannot be undone!
      </div>
      <div class="modal-footer">
        <button class="float-left btn btn-secondary mr-3" data-dismiss="modal" aria-label="Close">No, take me back!</button>
        <form method="POST" action="/groups/{{ $group->id }}">
          @csrf
          @method("DELETE")
          <button class="float-right btn btn-danger" onclick="this.form.submit()">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
