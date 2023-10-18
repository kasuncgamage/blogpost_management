<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogPostResource;
use App\Models\BlogPostModel;
use App\Models\PostTypeModel;
use App\Services\BlogPostService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(BlogPostService $blogPostService){
        $allPosts = $blogPostService->showAllPosts();
        $postTypes = PostTypeModel::all();
        return view('welcome',compact('allPosts','postTypes'));
    }

    public function moreDetails($post_id){
        $post = BlogPostModel::find($post_id);
        return view('moreDetails',compact('post'));
    }
}
