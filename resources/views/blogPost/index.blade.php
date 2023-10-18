@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="row gy-1">
                    <div class="col-6 text-start">
                        <h2>Blog Posts</h2>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-success" href="{{ route('blogPost.create') }}"> New Post </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Author</th>
                            <th>Publish Date</th>
                            <th>Created date</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogPosts as $blogPost)
                        <tr>
                            <td>{{ $blogPost->blog_post_id }}</td>
                            <td>{{ $blogPost->blog_post_title }}</td>
                            <td>
                                {{ Str::limit($blogPost->blog_post_content, $limit = 50, $end = '...') }}
                            </td>
                            <td>{{ $blogPost->author->name }}</td>
                            <td>{{ $blogPost->blog_post_publish_date }}</td>
                            <td>{{ $blogPost->blog_post_created_at }}</td>
                            <td width="17%">
                                <div class="row text-center">
                                    <div class="col-3 text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ route('blogPost.edit', $blogPost->blog_post_id) }}">Edit</a>
                                    </div>
                                    <div class="col-3 text-center ">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('blogPost.show', $blogPost->blog_post_id) }}">Show</a>
                                    </div>
                                    <div class="col-3 text-center ">
                                        <form action="{{ route('blogPost.destroy', $blogPost->blog_post_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $blogPosts->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection