@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h1 class="col-md-8 mb-4">Group info</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      @component('groups.components.group', ['group' => $group])@endcomponent
    </div>
  </div>
  <div class="row justify-content-center mb-4">
    <div class="col-md-8">
      Owner: {{ $group->owner->name }}
    </div>
  </div>
  @foreach($group->members as $member)
    @if ($member->id === Auth::id() && $group->owner->id !== Auth::id())
      <div class="row justify-content-center mb-4">
        <div class="col-md-8">
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

  @if (Auth::user()->id === $group->owner->id)
    @component('components.danger-zone')
      @slot('entity'){{ 'group' }}@endslot
    @endcomponent
  @endif
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
