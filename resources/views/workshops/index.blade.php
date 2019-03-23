@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($workshops as $workshop)
      <div class="card mb-4">
        <div class="card-header">
          <a href="./workshops/{{ $workshop->id }}">{{ $workshop->title }}</a>
        </div>
        <div class="card-body">
          <div>{{ $workshop->description }}</div>
          @if (Auth::check())
            @if (!$workshop->users()->get()->contains(Auth::user()))
              <form method="POST" action="/participants/{{ Auth::id() }}">
                @method('PATCH')
                @csrf
                <input type="hidden" name="workshop" value="{{ $workshop->id }}">
                <button type="button" onclick="this.form.submit()" class="btn btn-primary mt-3">Participate</button>
              </form>
            @else
              <form method="POST" action="/participants/{{ Auth::id() }}">
                @method('DELETE')
                @csrf
                <input type="hidden" name="workshop" value="{{ $workshop->id }}">
                <button type="button" onclick="this.form.submit()" class="btn btn-danger mt-3">Unlist</button>
              </form>
            @endif
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
