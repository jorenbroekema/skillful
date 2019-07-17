@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h1 class="col-md-8">Workshops</h1>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($workshops as $workshop)
        @if ($workshop->public ||
             $workshop->sharesGroupWith(Auth::user(), true) ||
             Auth::user()->isSuperUser()
        )
          @component('workshops.components.workshop', ['workshop' => $workshop])
          @endcomponent
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection
