@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="row gy-5">
                    <div class="col-6 text-start">
                        <h2>Edit Post</h2>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-primary" href="{{ route('blogPost.index') }}"> Back</a>
                    </div>
                </div>
            </div>


            <div class="card p-2">

                <form action="{{ route('blogPost.update',$blogPost) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="blog_post_title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="blog_post_title" name="blog_post_title" placeholder="title" value="{{ $blogPost->blog_post_title }}">
                        @error('blog_post_title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="blog_post_content" class="form-label">Content:</label>
                        <textarea class="form-control date" id="blog_post_content" name="blog_post_content" placeholder="content">{{ $blogPost->blog_post_content }}</textarea>
                        @error('blog_post_content')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="blog_post_publish_date" class="form-label">Publish Date:</label>
                        <input type="date" class="form-control" id="blog_post_publish_date" name="blog_post_publish_date" value="{{ $blogPost->blog_post_publish_date }}">
                        @error('blog_post_publish_date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="post_type_id" class="form-label">Post Type{{$blogPost->post_type_id}}</label>
                        <select class="form-select" name="post_type_id" id="post_type_id">
                            <option value="">Select Post Type</option>
                            @foreach($postTypes as $postType)
                            <option <?= ($blogPost->post_type_id == $postType->post_type_id) ? 'selected' : '' ?> value="{{$postType->post_type_id}}">{{ $postType->post_type_desc }}</option>
                            @endforeach
                        </select>

                        @error('post_type_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="blog_post_image" class="form-label">Images:</label>
                        <input type="file" multiple class="form-control" id="blog_post_image" name="blog_post_image[]" placeholder="Name">
                        @error('blog_post_image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <br>
                        <div class="row">
                            @if($images)
                            @foreach ($images as $image)
                            <div class="col-lg-1">
                                <img src="{{url('images')}}\{{$image}}" alt="Uploaded Image" width="100">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection