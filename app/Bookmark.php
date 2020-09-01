<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $primaryKey = 'bookmark_id';

    protected $fillable = [
        'user_id', 'article_id',
    ];
}
