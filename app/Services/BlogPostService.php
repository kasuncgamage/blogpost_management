<?php

namespace App\Services;

use App\Http\Resources\BlogPostResource;
use App\Models\BlogPostModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BlogPostService
{
    public function showPostByUser()
    {
        try {

            $data = BlogPostModel::filterByUserId()->orderBy("blog_post_id", "DESC")->paginate(10);
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function destroyPost($blogPostModel)
    {
        try {
            $blogPostModel->blog_post_deleted_at = Carbon::now()->format("Y-m-d H:i:s");
            $blogPostModel->delete();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveNewPost($request)
    {
        DB::beginTransaction();
        try {
            $request->request->set("author_id", auth()->user()->id);
            $post = BlogPostModel::create($request->post());
            //validate image
            if ($request->hasFile('blog_post_image')) {
                $img_urls = $this->moveImages($request->file('blog_post_image'));
                $post->blog_post_image_url = json_encode($img_urls);
                $post->save();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updatePost($blogPostModel, $request)
    {
        DB::beginTransaction();

        try {
            $request->request->set("blog_post_updated_at", Carbon::now()->format("Y-m-d H:i:s"));
            $request->request->set("author_id", auth()->user()->id);
            $blogPostModel->fill($request->post());
            if ($request->hasFile('blog_post_image')) {
                $img_urls = $this->moveImages($request->file('blog_post_image'));
                $blogPostModel->blog_post_image_url = json_encode($img_urls);
            }
            $blogPostModel->update();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    private function moveImages($blog_post_image)
    {
        try {
            $imageNameArray = [];
            foreach ($blog_post_image as $image) {
                $imageName = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imageNameArray[] = $imageName;
            }
            return $imageNameArray;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showAllPosts()
    {
        try {
            $data = BlogPostModel::orderBy("blog_post_publish_date", "DESC")
            // ->where("blog_post_publish_date","<=", Carbon::now()->format("Y-m-d H:i:s"))
            ->paginate(10);
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
