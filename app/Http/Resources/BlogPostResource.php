<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($post) {
                return [
                    'postType' => $post->postType->post_type_desc,
                    'postTitle' => $post->blog_post_title,
                    'publishDate' => $post->blog_post_publish_date,
                    'postContent' => $post->blog_post_content,
                    'postImages' => $post->blog_post_image_url,
                    'postAuthor' => $post->author->name,
                ];
            }),
        ];
    }
}
