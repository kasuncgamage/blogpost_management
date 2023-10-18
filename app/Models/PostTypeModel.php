<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTypeModel extends Model
{
    use HasFactory;

    protected $table = 'post_types';
    protected $primaryKey = 'post_type_id';
    const CREATED_AT  = 'post_type_created_at';
    const UPDATED_AT = 'post_type_updated_at';
    const DELETED_AT = 'post_type_deleted_at';

    protected $fillable =
    [
        'post_type_desc',
        'post_type_created_at',
        'post_type_updated_at',
        'post_type_deleted_at',
    ];
}
