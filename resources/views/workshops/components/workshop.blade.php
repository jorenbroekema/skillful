<div class="card mb-4">
  <div class="card-header">
    <a style="line-height: 36px;" href="/workshops/{{ $id }}">{{ $title }}</a>
    @if($canEdit == "true")
      <button
        class="float-right btn btn-primary"
        data-toggle="modal"
        data-target="#workshopEditModal-{{ $id }}"
      >Edit</button>
    @endif
  </div>
  <div class="card-body">
    <div>{{ $description }}</div>
    @if (Auth::check())
      @if ($isParticipating == 'false')
        <form method="POST" action="/participants/{{ Auth::id() }}">
          @method('PATCH')
          @csrf
          <input type="hidden" name="workshop" value="{{ $id }}">
          <button type="button" onclick="this.form.submit()" class="btn btn-primary mt-3">Participate</button>
        </form>
      @else
        <form method="POST" action="/participants/{{ Auth::id() }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="workshop" value="{{ $id }}">
          <button type="button" onclick="this.form.submit()" class="btn btn-danger mt-3">Unlist</button>
        </form>
      @endif
    @endif
  </div>
</div>

@if($canEdit == "true")
<!-- Edit Modal -->
<div class="modal fade" id="workshopEditModal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="workshopEditModalLabel-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
<form method="POST" action="/workshops/{{ $id }}">
  @csrf
  @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="workshopEditModalLabel-{{ $id }}">Edit this workshop</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="workshop-form__workshopTitle">Workshop Name</label>
            <input
              id="workshop-form__workshopTitle"
              class="form-control"
              type="text"
              name="title"
              value="{{ $title }}"
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
              aria-describedby="workshopDescHelp"
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
