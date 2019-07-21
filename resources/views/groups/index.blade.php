@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Groups Overview</h1>
    </div>
    <div class="col-md-8">
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
          class="tab-pane col-md-12 fade show active"
          id="my-groups"
          role="tabpanel"
          aria-labelledby="nav-item__my-groups"
        >
          <h3>My Groups</h3>
          @if(isset($groups['ownGroups']))
            @foreach ($groups['ownGroups'] as $group)
              @component('groups.components.group', ['group' => $group])@endcomponent
            @endforeach
          @endif
        </div>
        <div
          class="tab-pane col-md-12 fade"
          id="all-groups"
          role="tabpanel"
          aria-labelledby="nav-item__all-groups"
        >
          <h3>All Groups</h3>
          @foreach ($groups['allGroups'] as $group)
            <!-- All groups are public for now, until groups can actually members invite -->
            @if(Auth::user() || $group->public)
              @component('groups.components.group', ['group' => $group])@endcomponent
            @endif
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

