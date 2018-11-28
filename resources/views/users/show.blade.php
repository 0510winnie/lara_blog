@extends('layouts.app')
@section('title',$user->name,'的用戶中心')
@section('content')
<div class="row">
  <div class="col-md-2 ">
    <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      <div class="card-body">
        <h6 class="card-title"><i class="fa fa-user nav-top-title mr-2" aria-hidden="true"></i>User Introduction:</h6>
        <p class="card-text">{{ $user->introduction }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><i class="fa fa-heart nav-top-title mr-3" aria-hidden="true"></i>Name：{{ $user->name }}</li>
        <li class="list-group-item"><i class="fa fa-paper-plane nav-top-title mr-3" aria-hidden="true"></i>Registered Data：{{$user->created_at->diffForHumans() }}</li>
        <li class="list-group-item"><i class="fa fa-clock-o nav-top-title mr-3" aria-hidden="true"></i>Last Active：{{$user->last_actived_at->diffForHumans() }}</li>
      </ul>
    </div>
  </div>

  <div class="col-md-8 ml-md-auto">
      <div class="card shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <span><i class="fa fa-user-circle font-awe nav-top-title" aria-hidden="true"></i></span>
            {{ $user->name }} 
          </div>
          <div class="card-body">
              <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link  {{ active_class(if_query('tab', null)) }}"  href="{{ route('users.show', $user->id) }}">{{ $user->name }} 的動態</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
                      <i class="fa fa-comments" style="color:LIGHTGREY" aria-hidden="true"></i>
                      {{ $user->name }} 的回覆
                    </a>
                  </li>
                 
                </ul>
                  @if(if_query('tab','replies'))
                    @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                  @else
                    @include('users._topics', ['topics'=> $user->topics()->recent()->paginate(6)])
                  @endif
          </div>
        </div>
  </div>
</div>
@endsection