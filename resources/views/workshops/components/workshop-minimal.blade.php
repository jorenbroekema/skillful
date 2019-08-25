<div class="{{ Auth::user()->owns($workshop) ? 'border-info border-width-2' : '' }} card mb-4">
  <div class="card-header">
    <a
      style="line-height: 36px;"
      href="/workshops/{{ $workshop->id }}"
    >
      {{ $workshop->title }}
      @if ($workshop->public)
        <span class="badge badge-secondary px-2">public</span>
      @endif
      @if (Auth::user()->owns($workshop))
        <span class="badge badge-primary px-2">your workshop</span>
      @endif
    </a>
    <div class="float-right">
      @if(Auth::user()->owns($workshop) || Auth::user()->isSuperUser())
        <button
          class="btn btn-secondary"
          data-toggle="modal"
          data-target="#workshopEditModal-{{ $workshop->id }}"
        >Edit</button>
      @endif
      @if (Auth::user()->id !== $workshop->owner->id)
        <form class="d-inline ml-2" method="POST" action="/participants/{{ Auth::id() }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="workshop" value="{{ $workshop->id }}">
          <button type="button" onclick="this.form.submit()" class="btn btn-danger">Unlist</button>
        </form>
      @endif
    </div>
  </div>
</div>

<!-- TODO: Abstract it to a component -->
@if(Auth::user() && (Auth::user()->owns($workshop) || Auth::user()->isSuperUser()))
<!-- Edit Modal -->
<div class="modal fade" id="workshopEditModal-{{ $workshop->id }}" tabindex="-1" role="dialog" aria-labelledby="workshopEditModalLabel-{{ $workshop->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
<form method="POST" action="/workshops/{{ $workshop->id }}">
  @csrf
  @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="workshopEditModalLabel-{{ $workshop->id }}">Edit this workshop</h5>
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
              value="{{ $workshop->title }}"
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
            >{{ $workshop->description }}</textarea>
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
              <option value="1"
                {{ $workshop->difficulty === 1 ? 'selected' : '' }}
              >Novice</option>
              <option value="2"
                {{ $workshop->difficulty === 2 ? 'selected' : '' }}
              >Intermediate</option>
              <option value="3"
                {{ $workshop->difficulty === 3 ? 'selected' : '' }}
              >Advanced</option>
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
              value="{{ str_replace(' ', 'T', $workshop->start_date) }}"
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
              value="{{ str_replace(' ', 'T', $workshop->end_date) }}"
            />
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
