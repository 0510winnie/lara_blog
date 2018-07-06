@extends('layouts.app')
@section('title', $topic->title)

@section('content')
  <div class="row">
    <div class="col-md-8 offest-md-2">
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">{{ $topic->title }}</div>
            <div class="card-body">
              <h4 class="card-title">{!! $topic->body !!}</h4>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
    </div>
  </div>
@endsection