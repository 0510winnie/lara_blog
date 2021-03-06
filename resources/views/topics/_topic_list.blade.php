@if(count($topics)) 
  @foreach($topics as $topic)
    <div class="col-lg-4 col-md-6 mb-4 ">
      <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
        <a href="{{ route('users.show', [$topic->user_id]) }}">
          <img class="card-img-top img-thumbnail" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->name }}">
        </a>
        <div class="card-body">
          <h6 class="card-title">
              <i class="fa fa-user" style="color:MEDIUMORCHID" aria-hidden="true"></i>
              <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                {{ $topic->user->name }}
              </a>
          </h6>
          <i class="fa fa-folder-open" style="color:MEDIUMSLATEBLUE" aria-hidden="true"></i>
          <a href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">{{ $topic->category->name }}</a>
          <hr>
          <p class="card-text"> </p>
          <a href="{{ $topic->link() }}" title="{{ $topic->title }}">{{ $topic->title }}</a>
        </div>
        <div class="card-footer topic-card-footer">
          <i class="fa fa-clock-o" style="color:DARKMAGENTA" aria-hidden="true"></i>
            <span class="timeago topic-span" title="最後活躍於">{{ $topic->created_at->diffForHumans() }}</span>
          <i class="fa fa-comments" style="color:MEDIUMSLATEBLUE" aria-hidden="true"></i>
            <span class="timeago">{{ $topic->reply_count }} 回覆</span>
        </div>
      </div>
    </div>
  @endforeach 
  @else
  <div class="empty-block">
    暫無動態
  </div>
@endif