<div class="card mb-4">
  <div class="card-header">
    <a style="line-height: 36px;" href="/groups/{{ $group->id }}">{{ $group->name }}</a>
    @if (Auth::user())
      <div class="float-right">
        @if (Auth::user()->owns($group))
          <button
            class="btn btn-secondary"
            data-toggle="modal"
            data-target="#groupEditModal-{{ $group->id }}"
          >Edit</button>
        @endif
        <!-- TODO: Change to "leave" button if user is already in group -->

        <form style="display:inline;" method="POST" action="/members/{{ Auth::id() }}">
          @method('PATCH')
          @csrf
          <input type="hidden" name="group" value="{{ $group->id }}">
          <button class="btn btn-primary" onclick="this.form.submit()">Join</button>
        </form>
      </div>
    @endif
  </div>
  <div class="card-body">
    <div class="mb-2">
      {{ $group->description }}
    </div>
  </div>
</div>

@if (Auth::user() && Auth::user()->owns($group))
<!-- Edit Modal -->
<div
  class="modal fade"
  id="groupEditModal-{{ $group->id }}"
  tabindex="-1"
  role="dialog"
  aria-labelledby="groupEditModalLabel-{{ $group->id }}"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <form method="POST" action="/groups/{{ $group->id }}">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="groupEditModalLabel-{{ $group->id }}">Edit this group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="group-form__groupName">Group Name</label>
            <input
              id="group-form__groupName"
              class="form-control"
              type="text"
              name="name"
              value="{{ $group->name }}"
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
              aria-describedby="groupDescHelp"
              rows="3"
            >{{ $group->description }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="this.form.submit()">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif
