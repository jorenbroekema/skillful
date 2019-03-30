@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if(isset($groups['ownGroups']) && $groups['ownGroups'])
      @foreach ($groups['ownGroups'] as $group)
        @component('groups.show')
          @slot('name'){{ $group->name }}@endslot
          @slot('id'){{ $group->id }}@endslot
          @slot('description'){{ $group->description }}@endslot
        @endcomponent
      @endforeach
      @endif
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($groups['allGroups'] as $group)
        @component('groups.show')
          @slot('name'){{ $group->name }}@endslot
          @slot('id'){{ $group->id }}@endslot
          @slot('description'){{ $group->description }}@endslot
        @endcomponent
      @endforeach
    </div>
  </div>
</div>
@endsection

