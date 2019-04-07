<div class="card mb-4">
  <div class="card-header">
    <a style="line-height: 36px;" href="/groups/{{ $id }}">{{ $name }}</a>
    @if($canEdit == "true")
      <button
        class="float-right btn btn-primary"
        data-toggle="modal"
        data-target="#groupEditModal-{{ $id }}"
      >Edit</button>
    @endif
  </div>
  <div class="card-body">
    <div class="mb-2">
      {{ $description }}
    </div>
  </div>
</div>

@if($canEdit == "true")
<!-- Edit Modal -->
<div class="modal fade" id="groupEditModal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="groupEditModalLabel-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/groups/{{ $id }}">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="groupEditModalLabel-{{ $id }}">Edit this group</h5>
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
              value="{{ $name }}"
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
            >{{ $description }}</textarea>
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
