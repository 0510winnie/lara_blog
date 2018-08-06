{{-- Active Users --}}
@if(count($active_users))
<div class="list-group shadow-sm p-3 mb-5 mt-10 bg-white rounded ">
  <h6 class="text-center"><i class="fa fa-user mr-2 " style="color:GOLD" aria-hidden="true"></i>活躍用戶</h6>
    @foreach($active_users as $active_user)
      <a href="{{ route('users.show', $active_user->id) }}" class="list-group-item borderless">
        <div class="media-left media-middle">
            <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="img-circle media-object">
        </div>

        <div class="media-body">
            <span class="media-heading">{{ $active_user->name }}</span>
        </div>
      </a>
    @endforeach
  </div>
  @endif
