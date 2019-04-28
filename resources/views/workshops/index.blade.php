@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($workshops as $workshop)
        @component('workshops.components.workshop')
          @slot('canEdit'){{ 'true' }}@endslot
          @slot('title'){{ $workshop->title }}@endslot
          @slot('id'){{ $workshop->id }}@endslot
          @slot('description'){{ $workshop->description }}@endslot
          @slot('difficulty'){{ $workshop->difficulty }}@endslot
          @slot('start_date'){{ $workshop->start_date }}@endslot
          @slot('end_date'){{ $workshop->end_date }}@endslot
          @slot('isParticipating')
            {{ $workshop->users()->get()->contains(Auth::user()) ? 'true' : 'false' }}
          @endslot
        @endcomponent
      @endforeach
    </div>
  </div>
</div>
@endsection
