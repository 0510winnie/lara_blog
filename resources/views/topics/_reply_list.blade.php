{{-- replies list card start --}}
@foreach($replies as $index => $reply)
  <div class="card shadow p-3 mb-5 bg-white rounded">
    <div class="card-header">
      <span class="avatar">
        <a href="{{ route('users.show', [$reply->user_id]) }}">
          <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="img-circle avatar img-responsive font-awe " width="30px" height="30px">
          {{ $reply->user->name }}
        </a>
      </span>
      {{-- 回覆刪除按鈕 --}}
      @can('destroy', $reply)
      <span class="float-right ">
      <form action="{{ route('replies.destroy', $reply->id) }}" method="POST">
          {{ csrf_field() }} 
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-outline-warning shadow p-1 mb-2  rounded">
            <i class="fa fa-trash-o " style="color:GOLD" aria-hidden="true"></i>
            Delete
          </button>
        </form>
      </span>
      @endcan
    </div>

    <div class="card-body">
      <h3 class="card-title">
        {!! $reply->content !!}
      </h3>

      <div class="card-text">
        <i class="fa fa-clock-o font-awe" style="color:OLIVE" aria-hidden="true"></i>
        {{ $reply->created_at->diffForHumans() }}
      </div>
    </div>
  </div>
@endforeach