@extends('layouts.app')
@section('title', '我的通知')

@section('content')
  <div class="container">
    <div class="col-md-10 offest-md-1">
      <div class="card">
          <h5 class="card-header">
            <i class="fa fa-comments-o font-awe" style="color:LIGHTGREY" aria-hidden="true"></i>
              我的通知
          </h5>
          <div class="card-body">
            @if($notifications->count())
              @foreach($notifications as $notification)
                @include('notifications.types._' . snake_case(class_basename($notification->type)))
              @endforeach
              {!! $notifications->render() !!}

            @else
            <p class="card-text">沒有消息通知</p>
            @endif
          </div>
        </div>
      {{-- end of the card --}}
      </div>
    </div>
  </div>
@endsection