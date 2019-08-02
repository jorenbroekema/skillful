<div class="card mb-4">
  <div class="card-header">
    <a
      style="line-height: 36px;"
      href="/workshops/{{ $workshop->id }}"
    >
      {{ $workshop->title }}
      @if ($workshop->public)
        <span class="badge badge-secondary">public</span>
      @endif
    </a>
    @if(Auth::user() && (Auth::user()->owns($workshop) || Auth::user()->isSuperUser()))
      <button
        class="float-right btn btn-secondary"
        data-toggle="modal"
        data-target="#workshopEditModal-{{ $workshop->id }}"
      >Edit</button>
    @endif
  </div>
  <div class="card-body">
    <div>{{ $workshop->description }}</div>
    @if ($workshop->group)
      <div class="mt-2">
        Group: <a href="/groups/{{ $workshop->group->id }}">{{ $workshop->group->name }}</a>
      </div>
    @endif
    <div class="mt-2">
      Teacher: <a href="#">{{ $workshop->owner->name }}</a>
    </div>
  </div>
  <div class="card-body">
    <div class="row justify-content-between">
      <div class="col-md-auto">
        <div class="row text-center">
          <div class="col date date--start">
            <div class="date__heading text-uppercase h6">Start date</div>
            <div class="date__card shadow p-4 bg-white rounded">
              <div class="h4 bold"><strong>{{ (new DateTime($workshop->start_date))->format('d') }}</strong></div>
              <div>{{ (new DateTime($workshop->start_date))->format('F') }}</div>
              <div class="mt-2"><em>{{ (new DateTime($workshop->start_date))->format('H:i A') }}</em></div>
            </div>
          </div>
          <div class="col date date--end">
            <div class="date__heading text-uppercase h6">End date</div>
            <div class="date__card shadow p-4 bg-white rounded">
              <div class="h4 bold"><strong>{{ (new DateTime($workshop->end_date))->format('d') }}</strong></div>
              <div>{{ (new DateTime($workshop->end_date))->format('F') }}</div>
              <div class="mt-2"><em>{{ (new DateTime($workshop->end_date))->format('H:i A') }}</em></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-auto align-self-end">
        <div class="d-flex flex-column align-items-end mt-3">
          <div class="d-flex align-items-end">
            <!-- TODO: DRY.. -->
            @switch ($workshop->difficulty)
              @case(1)
                <div class="bg-success ml-1" style="width: 10px; height: 10px; border-radius: 5px;"></div>
                <div class="bg-secondary ml-1" style="width: 10px; height: 20px; border-radius: 5px;"></div>
                <div class="bg-secondary ml-1" style="width: 10px; height: 30px; border-radius: 5px;"></div>
                @break
              @case (2)
                <div class="bg-warning ml-1" style="width: 10px; height: 10px; border-radius: 5px;"></div>
                <div class="bg-warning ml-1" style="width: 10px; height: 20px; border-radius: 5px;"></div>
                <div class="bg-secondary ml-1" style="width: 10px; height: 30px; border-radius: 5px;"></div>
                @break
              @case (3)
                <div class="bg-danger ml-1" style="width: 10px; height: 10px; border-radius: 5px;"></div>
                <div class="bg-danger ml-1" style="width: 10px; height: 20px; border-radius: 5px;"></div>
                <div class="bg-danger ml-1" style="width: 10px; height: 30px; border-radius: 5px;"></div>
                @break
            @endswitch
          </div>
          @if (Auth::check() && Auth::user()->id !== $workshop->owner->id)
            <div class="participate-button mt-4">
              @if (!$workshop->users()->get()->contains(Auth::user()))
                <form method="POST" action="/participants/{{ Auth::id() }}">
                  @method('PATCH')
                  @csrf
                  <input type="hidden" name="workshop" value="{{ $workshop->id }}">
                  <button type="button" onclick="this.form.submit()" class="btn btn-primary">Participate</button>
                </form>
              @else
                <form method="POST" action="/participants/{{ Auth::id() }}">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="workshop" value="{{ $workshop->id }}">
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
