@extends('layouts.app') 
@section('title','編輯用戶個人資料') 

@section('content')
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header">
        編輯用戶資料
      </div>
      @include('common.error')
      <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">  
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="name">用戶名稱</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="請輸入用戶名稱" value="{{ old('name', $user->name) }}">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="請輸入 Email" value="{{ old('email', $user->email) }}">
          </div>

          <div class="form-group">
            <label for="introduction">個人簡介</label>
            <textarea name="introduction" id="introduction" name="introduction" rows="3" class="form-control">{{ old('introduction'), $user->introduction }}</textarea>
          </div>

          <div class="form-group">
            <label for="avatar" class="avatar-label">用戶頭像</label>
            <input type="file" name="avatar" class="form-control">
            @if($user->avartar)
              <br>
              <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="thumbnail img-responsive" width="200">
            @endif
          </div>

          <button type="submit" class="btn btn-primary">保存</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection