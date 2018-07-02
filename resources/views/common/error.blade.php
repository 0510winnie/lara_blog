@if(count($errors) > 0)
  <div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>有錯誤！</strong> 
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li> 
        @endforeach
    </ul>
  </div>
@endif