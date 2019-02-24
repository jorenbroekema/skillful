@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($workshops as $workshop)
      <div class="card">
        <div class="card-header">{{ $workshop->title }}</div>

        <div class="card-body">
          {{ $workshop->description }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
