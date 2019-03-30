@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 36rem;">
  <h1 class="row mb-4">Groups Overview</h1>

  <!-- Tabs navigation -->
  <ul class="nav nav-tabs row mb-4">
    <li class="nav-item">
      <a
        href="#my-groups"
        class="nav-link active show"
        id="nav-item__my-groups"
        data-toggle="tab"
        role="tab"
        aria-controls="my-groups"
        aria-selected="true"
      >My Groups</a>
    </li>
    <li class="nav-item">
      <a
        href="#all-groups"
        class="nav-link"
        id="nav-item__all-groups"
        data-toggle="tab"
        role="tab"
        aria-controls="all-groups"
        aria-selected="false"
      >All Groups</a>
    </li>
  </ul>

  <!-- Tabs content -->
  <div class="tab-content row">
    <div
      class="tab-pane fade show active"
      id="my-groups"
      role="tabpanel"
      aria-labelledby="nav-item__my-groups"
    >
      <h3>My Groups</h3>
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
    <div
      class="tab-pane fade"
      id="all-groups"
      role="tabpanel"
      aria-labelledby="nav-item__all-groups"
    >
      <h3>All Groups</h3>
      @foreach ($groups['allGroups'] as $group)
        @component('groups.show')
          @slot('name'){{ $group->name }}@endslot
          @slot('id'){{ $group->id }}@endslot
          @slot('description'){{ $group->description }}@endslot
        @endcomponent
      @endforeach
      </ul>
    </div>
  </div>

</div>
@endsection

