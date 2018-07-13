@include('common.error')
<div class="card shadow p-3 mb-5 bg-white rounded">
    <div class="card-body">
      <div class="card-text">
          留言給 
          <i class="fa fa-user-circle" style="color:GOLDENROD" aria-hidden="true"></i>
          {{ $topic->user->name }}
      </div>
      <hr>
      <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
          <textarea name="content" cols="30" rows="3" class="form-control" placeholder="分享你的想法..."></textarea>
        </div>
          <button type="submit" class="btn btn-outline-warning">回覆</button>
      </form>
    </div>
  </div>