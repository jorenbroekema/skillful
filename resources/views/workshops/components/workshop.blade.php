<div class="card mb-4">
  <div class="card-header">
    <a style="line-height: 36px;" href="/workshops/{{ $id }}">{{ $title }}</a>
    @if($canEdit == "true")
      <button
        class="float-right btn btn-secondary"
        data-toggle="modal"
        data-target="#workshopEditModal-{{ $id }}"
      >Edit</button>
    @endif
  </div>
  <div class="card-body">
    <div>{{ $description }}</div>
    <div class="mt-2">
      By: <a href="#">Joren Broekema</a>
    </div>
  </div>
  <div class="card-body">
    <div class="row justify-content-between">
      <div class="col-md-auto">
        <div class="row text-center">
          <div class="col date date--start">
            <div class="date__heading text-uppercase h6">Start date</div>
            <div class="date__card shadow p-4 bg-white rounded">
              <div class="h4 bold"><strong>08</strong></div>
              <div>Jun 18</div>
              <div class="mt-2"><em>13:00</em></div>
            </div>
          </div>
          <div class="col date date--end">
            <div class="date__heading text-uppercase h6">End date</div>
            <div class="date__card shadow p-4 bg-white rounded">
              <div class=" h4 bold"><strong>08</strong></div>
              <div>Jun 18</div>
              <div class="mt-2"><em>16:00</em></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-auto align-self-end">
        <div class="d-flex flex-column align-items-end mt-3">
          <div class="d-flex align-items-end">
            <div class="bg-warning ml-1" style="width: 10px; height: 10px; border-radius: 5px;"></div>
            <div class="bg-warning ml-1" style="width: 10px; height: 20px; border-radius: 5px;"></div>
            <div class="bg-secondary ml-1" style="width: 10px; height: 30px; border-radius: 5px;"></div>
          </div>
          @if (Auth::check())
            <div class="participate-button mt-4">
              @if ($isParticipating == 'false')
                <form method="POST" action="/participants/{{ Auth::id() }}">
                  @method('PATCH')
                  @csrf
                  <input type="hidden" name="workshop" value="{{ $id }}">
                  <button type="button" onclick="this.form.submit()" class="btn btn-primary">Participate</button>
                </form>
              @else
                <form method="POST" action="/participants/{{ Auth::id() }}">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="workshop" value="{{ $id }}">
                  <button type="button" onclick="this.form.submit()" class="btn btn-danger">Unlist</button>
                </form>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
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
