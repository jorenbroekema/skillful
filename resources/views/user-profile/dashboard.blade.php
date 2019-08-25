@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
      <div class="col justify-content-center">
        <h1 class="text-center mb-4">Dashboard</h1>
        <div class="avatar-wrapper mx-auto bg-white rounded-circle border-dark overflow-hidden"></div>
        <h3 class="mt-3 text-center">{{ Auth::user()->name }}</h3>
      </div>
    </div>
    <div class="row mb-4">
      <nav class="col w-100">
        <div class="nav nav-tabs nav-fill justify-content-center" id="nav-tab" role="tablist">
          <a
            class="nav-item nav-link active"
            id="nav-workshops-tab"
            data-toggle="tab"
            href="#nav-workshops"
            role="tab"
            aria-controls="nav-workshops"
            aria-selected="true"
          >Workshops</a>
          <a
            class="nav-item nav-link"
            id="nav-groups-tab"
            data-toggle="tab"
            href="#nav-groups"
            role="tab"
            aria-controls="nav-groups"
            aria-selected="false"
          >Groups</a>
          <a
            class="nav-item nav-link"
            id="nav-skills-tab"
            data-toggle="tab"
            href="#nav-skills"
            role="tab"
            aria-controls="nav-skills"
            aria-selected="false"
          >Skills</a>
          <a
            class="nav-item nav-link"
            id="nav-account-tab"
            data-toggle="tab"
            href="#nav-account"
            role="tab"
            aria-controls="nav-account"
            aria-selected="false"
          >Account</a>
        </div>
      </nav>
    </div>
    <div class="row">
      <div class="col tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-workshops" role="tabpanel" aria-labelledby="nav-workshops-tab">
          @include('user-profile.workshops', [
            'workshops' => Auth::user()->upcomingWorkshops(),
          ])
        </div>
        <div class="tab-pane fade" id="nav-groups" role="tabpanel" aria-labelledby="nav-groups-tab">
          @include('user-profile.groups', ['groups' => Auth::user()->groups()->get()])
        </div>
        <div class="tab-pane fade" id="nav-skills" role="tabpanel" aria-labelledby="nav-skills-tab">
          @include('user-profile.skills')
        </div>
        <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
          @include('user-profile.account')
        </div>
      </div>
    </div>
  </div>

  @include('user-profile.components.change-password')
  @include('user-profile.components.change-email')
@endsection
