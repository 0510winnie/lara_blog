{{-- 別的用戶的留言 --}}

<div class="avatar float-left mr-4">
  <a href="{{ route('users.show', $notification->data['user_id']) }}">
    <img class="avatar img-thumbnail" src="{{ $notification->data['user_avatar'] }}" alt="{{ $notification->data['user_name'] }}" style="width: 80px; height:80px;">
  </a>
</div>

<div class="info">
  <a href="{{ route('users.show', $notification->data['user_id']) }} ">{{ $notification->data['user_name'] }}</a>
  評論了
  <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>

  {{-- 刪除按鈕 --}}
  <span class="float-right" title="{{ $notification->created_at->diffForHumans() }}">
    <i class="fa fa-clock-o font-awe" style="color:LIGHTGREY" aria-hidden="true"></i>
    {{ $notification->created_at->diffForHumans() }}
  </span>

  <div class="reply-content">
    {!! $notification->data['reply_content'] !!}
  </div>
</div>