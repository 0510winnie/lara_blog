<div class="tab-pane fade show active" id="replies">
@if(count($replies))
<ul class="list-group shadow-sm p-3 mb-5 bg-white rounded">
  @foreach($replies as $reply)
    <li class="list-group-item  shadow-sm p-3 mb-5 bg-white rounded">
      <a href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">{{ $reply->topic->title }}</a>
      <hr>
      <div class="reply-content">
        {!! $reply->content !!}
      </div>
        
        <span class="badge badge-light badge-pill float-right">
          回覆於
          {{ $reply->created_at->diffForHumans() }} 
        </span>
    </li>
  @endforeach
  </ul>

  @else
    <div class="empty-block">暫無回覆</div>
@endif

{{-- 分頁 --}}
<div class="pag-margin">
  {!! $replies->appends(Request::except('page'))->render() !!}
</div>
</div>