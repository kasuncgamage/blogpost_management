<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPostModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'blog_posts';
    protected $primaryKey = 'blog_post_id';
    const CREATED_AT  = 'blog_post_created_at';
    const UPDATED_AT = 'blog_post_updated_at';
    const DELETED_AT = 'blog_post_deleted_at';

    protected $fillable =
    [
        'author_id',
        'post_type_id',
        'blog_post_title',
        'blog_post_content',
        'blog_post_content_short',
        'blog_post_publish_date',
        'blog_post_image_url',
        'blog_post_created_at',
        'blog_post_updated_at',
        'blog_post_deleted_at',
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function postType()
    {
        return $this->hasOne(PostTypeModel::class, 'post_type_id', 'post_type_id');
    }

    public function scopeFilterByUserId($query)
    {
        if (auth()->user()->id)
            return $query->where('author_id', auth()->user()->id);
    }
}
