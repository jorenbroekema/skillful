<div class="mb-4 d-flex">
  <h3 class="mb-0 mr-2">Skills</h3>
  <div class="btn btn-sm btn-primary" style="line-height: 1.6">+</div>
</div>
<div class="mb-4 row">
  @foreach(Auth::user()->skills as $skill)
    <div class="col-md-4">
      @component('user-profile.components.skill', ['skill' => $skill])@endcomponent
    </div>
  @endforeach
</div>

<div class="mb-4 d-flex">
  <h3 class="mb-0 mr-2">Goals</h3>
  <div class="btn btn-sm btn-primary" style="line-height: 1.6">+</div>
</div>
<div class="mb-4 row">
  @foreach(Auth::user()->wantedSkills as $skill)
    <div class="col-md-4">
      @component('user-profile.components.skill', ['skill' => $skill])@endcomponent
    </div>
  @endforeach
</div>
