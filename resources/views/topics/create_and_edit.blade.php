@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="card card-default shadow p-3 mb-5 bg-white rounded">

            <div class="card-body">
                <h2 class="text-center">
                    <span><i class="fa fa-pencil-square-o font-awe" style="color:LIGHTSKYBLUE" aria-hidden="true"></i></span>
                    @if($topic->id)
                        Edit Topic
                    @else
                        New Topic
                    @endif
                </h2>

                <hr>

                @include('common.error')

                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="請填寫標題" required/>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" required>
                            <option value="" hidden disabled selected>Select a Category</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="body">Content</label>
                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="內容需要至少三個字。" required>{{ old('body', $topic->body ) }}</textarea>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection