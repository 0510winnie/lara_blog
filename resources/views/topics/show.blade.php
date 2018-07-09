@extends('layouts.app') 
@section('title', $topic->title) 

@section('content')
<div class="row">
  <div class="col-md-2 ">
    <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
      <img class="card-img-top" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->name }}">
      <div class="card-body">
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">作者：{{ $topic->user->name }}</li>
        <li class="list-group-item">
          <i class="fa fa-clock-o font-awe" style="color:OLIVE" aria-hidden="true"></i>
          {{ $topic->created_at->diffForHumans() }}
        </li>
        <li class="list-group-item">
          <i class="fa fa-comments font-awe" style="color:KHAKI" aria-hidden="true"></i>
          {{ $topic->reply_count }} 回覆
        </li>
        @can('update', $topic)
        <li class="list-group-item justify-content justify-content-around d-flex">
          <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary font-awe">
            <i class="fa fa-pencil-square-o" style="color:GREY" aria-hidden="true"></i>
            Edit
          </a>

          <form action="{{ route('topics.destroy', $topic->id) }}" method="POST">
            {{ csrf_field() }} 
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-outline-warning ">
              <i class="fa fa-trash-o " style="color:GOLD" aria-hidden="true"></i>
              Delete
            </button>
          </form>
        </li>
        @endcan
      </ul>
    </div>
  </div>

  <div class="col-md-8 ml-md-auto">
    <div class="card shadow p-3 mb-5 bg-white rounded">
      <div class="card-header">
        <span>
          <i class="fa fa-user-circle font-awe" style="color:GOLDENROD" aria-hidden="true"></i>
        </span>
        {{ $topic->user->name }}

      </div>
      <div class="card-body">
        <h3 class="card-title">{{ $topic->title }}</h3>


        <div class="card-text">
          {!! $topic->body !!}
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection