@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <h3>Post</h3>
        <a href="{{route('admin.post')}}" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left"></span> Back
        </a>
        <form method="POST" @if(isset($post)) action="{{route('admin.post.change',$post->id)}}" @else action="{{route('admin.post.create')}}" @endif enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tiêu đề bài viết</label>
                <input type="text" class="form-control title @error('title') is-invalid @enderror" name="title" placeholder="Nhập vào tiêu đề" @if(isset($post)) value="{{ $post->title }}" @else value="{{ old('title') }}" @endif autocomplete="title">
            
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>URL bài viết</label>
                <input type="text" class="form-control slug @error('slug') is-invalid @enderror" placeholder="Nhấp vào để tự tạo" name="slug" @if(isset($post)) value="{{ $post->slug }}" @else value="{{ old('slug') }}" @endif autocomplete="slug">
            
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="url_image" class="control-label mb-1">Image Thumbnail</label>
                <input name="url_image" class="form-control-file @error('url_image') is-invalid @enderror" type='file' id="url_image_post" / value="{{ old('url_image') }}" autocomplete="url_image">
                <img id="postthumb" @if(isset($post)) src="/storage/{{$post->url_thumb}}" width="200px" height="200px" @else src="" @endif alt="" />
                <div id="errorimage"></div>

                @error('url_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Từ khoá bài viết</label>
                <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword" placeholder="Nhập từ khóa của bài viết" @if(isset($post)) value="{{$post->keyword}}" @else value="{{ old('keyword') }}" @endif autocomplete="keyword">
                
                @error('keyword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Nội dung bài viết</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="editor1">@if(isset($post)) {{$post->content}} @else {{ old('content') }} @endif</textarea>

                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                @if (isset($post))
                <button type="submit" class="btn btn-primary">Sửa</button>
                @else
                <button type="submit" class="btn btn-primary">Tạo</button>
                @endif
            </div>
        </form>
    </div>
</div>


@endsection