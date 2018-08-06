@extends('layouts.app')
@section('title', isset($category) ? $category->name : '動態列表')

@section('content')

<div class="row">

  <div class="col-lg-3">

    @if(isset($category))
      <div class="alert alert-dismissible alert-secondary" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $category->name }} :</strong> {{ $category->description }}
      </div>
    @endif

    <h1 class="my-4"></h1>
    <div class="list-group shadow-sm p-3 mb-5 bg-white rounded ">
      <a href="{{ Request::url() }}?order=default" class="list-group-item borderless {{ active_class( ! if_query('order','recent')) }}">最後回覆</a>
      <a href="{{ Request::url() }}?order=recent" class="list-group-item borderless {{ active_class(if_query('order','recent')) }}">最新發佈</a>
      <a href="{{ route('topics.create') }}" class="list-group-item borderless">
          新增動態
        </a>
      {{-- Request::url()獲取的是當前請求的url --}}
    </div>

      {{-- Active Users --}}
      @include('topics._sidebar')
        
  </div>
  <!-- /.col-lg-3 -->

  <div class="col-lg-9">

    <div id="carouselExampleIndicators" class="carousel slide my-4 shadow p-3 mb-5 bg-white rounded" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="{{ asset('/carousel_images/1.jpg') }}" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{ asset('/carousel_images/3.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{ asset('/carousel_images/2.jpg') }}" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="row">

      {{-- 狀態列表 --}}
      @include('topics._topic_list', ['topics' => $topics])
      {{-- 分頁 --}}
      {{-- {!! $topics->appends($request->except('page'))->render() !!} --}}
  

      
      

      

    

     

    </div>
    <!-- /.row -->

  </div>
  <!-- /.col-lg-9 -->

</div>
@endsection
