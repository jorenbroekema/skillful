<h3 class="mb-4">My groups</h3>

@if ($groups->count() < 1)
  <p>You are not in any group.</p>
@endif
@foreach ($groups->sortBy(function ($group, $key) {
  return !Auth::user()->owns($group);
}) as $group)
  @component('groups.components.group-minimal', ['group' => $group])@endcomponent
@endforeach
