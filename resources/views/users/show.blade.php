@extends('layouts.app')
@section('title',$user->name,'的用戶中心')
@section('content')
<div class="row">
  <div class="col-md-2 ">
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      <div class="card-body">
        <h5 class="card-title">自我介紹</h5>
        <p class="card-text">{{ $user->introduction }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">用戶名：{{ $user->name }}</li>
        <li class="list-group-item">註冊於： {{$user->created_at->diffForHumans() }}</li>
      </ul>
      <div class="card-body">
        <a href="{{ route('users.edit', $user->id) }}" class="card-link">編輯</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
  </div>

  <div class="col-md-8 ml-md-auto">
      <div class="card">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
  </div>
</div>
@endsection