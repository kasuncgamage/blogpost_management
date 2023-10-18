<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPostModel;
use App\Models\PostTypeModel;
use App\Services\BlogPostService;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    private $blogPostService;
    public function __construct(BlogPostService $blogPostService)
    {
        $this->middleware('auth');
        $this->blogPostService = $blogPostService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = $this->blogPostService->showPostByUser();
        return view('blogPost.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postTypes = PostTypeModel::all();
        return view('blogPost.create',['postTypes'=> $postTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostRequest $request)
    {
 
        $blogPosts = $this->blogPostService->saveNewPost($request);
        if($blogPosts === true){
            return redirect()->route('blogPost.index')->with('success','Post has been created successfully.');
        }else{
            return redirect()->route('blogPost.index')->with('success','Something went wrong.('.$blogPosts.')');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPostModel  $blogPostModel
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPostModel $blogPost)
    {
        $postTypes = PostTypeModel::all();
        $images = json_decode($blogPost->blog_post_image_url);
        return view('blogPost.show',compact('blogPost','postTypes','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPostModel  $blogPostModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPostModel $blogPost)
    {
        $postTypes = PostTypeModel::all();
        $images = json_decode($blogPost->blog_post_image_url);
        return view('blogPost.edit',compact('blogPost','postTypes','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPostModel  $blogPostModel
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostRequest $request, BlogPostModel $blogPost)
    {
        $res = $this->blogPostService->updatePost($blogPost,$request);
        if($res === true){
            return redirect()->route('blogPost.index')->with('success','Post has been updated successfully.');
        }else{
            return redirect()->route('blogPost.index')->with('success','Something went wrong.('.$res.')');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPostModel  $blogPostModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPostModel $blogPost)
    {
        $this->blogPostService->destroyPost($blogPost);
        return redirect()->route('blogPost.index')->with('success','Post has been deleted successfully');
    
    }
}
