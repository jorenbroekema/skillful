<h3 class="mb-4">Upcoming workshops</h3>

@if ($workshops->count() < 1)
  <p>You have not signed up for any upcoming workshops.</p>
@endif
@foreach ($workshops as $workshop)
  @component('workshops.components.workshop-minimal', ['workshop' => $workshop])@endcomponent
@endforeach
