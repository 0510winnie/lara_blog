@if(count($topics))
<ul class="list-group shadow-sm p-3 mb-5 bg-white rounded">
  @foreach($topics as $topic)
    <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm p-3 mb-5 bg-white rounded">
      <a href="{{ route('topics.show', $topic->id) }}">{{ $topic->title }}</a>
      <span class="badge badge-light badge-pill">{{ $topic->reply_count }} 
        Replies
      </span>
    </li>
  @endforeach
  </ul>

  @else
    <div class="empty-block">No Feeds Yet</div>
@endif

{{-- 分頁 --}}
<div class="pag-margin">
  {!! $topics->render() !!}
</div>