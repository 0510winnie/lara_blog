@extends('layouts.app')
@section('title',$user->name,'的用戶中心')
@section('content')
<div class="row">
  <div class="col-md-2">
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="https://fsdhubcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">自我介紹</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">用戶名：{{ $user->name }}</li>
        <li class="list-group-item">註冊於： {{$user->created_at->toFormattedDateString() }}</li>
      </ul>
      <div class="card-body">
        <a href="#" class="card-link">Card link</a>
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