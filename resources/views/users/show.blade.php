@extends('layouts.app')
@section('title',$user->name,'的用戶中心')
@section('content')
<div class="row">
  <div class="col-md-2 ">
    <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      <div class="card-body">
        <h5 class="card-title">自我介紹</h5>
        <p class="card-text">{{ $user->introduction }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">用戶名：{{ $user->name }}</li>
        <li class="list-group-item">註冊於：{{$user->created_at->diffForHumans() }}</li>
      </ul>
      <div class="card-body">
        <a href="{{ route('users.edit', $user->id) }}" class="card-link">編輯</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
  </div>

  <div class="col-md-8 ml-md-auto">
      <div class="card shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <span><i class="fa fa-user-circle font-awe" style="color:GOLDENROD" aria-hidden="true"></i></span>
            {{ $user->name }} 
          </div>
          <div class="card-body">
              <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active " data-toggle="tab" href="#home">{{ $user->name }} 的動態</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile">
                      <i class="fa fa-comments" style="color:LIGHTGREY" aria-hidden="true"></i>
                      回覆
                    </a>
                  </li>
                 
                </ul>
                <div id="myTabContent" class="tab-content">
                  @include('users._topics', ['topics'=> $user->topics()->recent()->paginate(6)])
                </div>
          </div>
        </div>
  </div>
</div>
@endsection