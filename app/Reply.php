<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $primaryKey = 'reply_id';

    protected $fillable = ['user_id', 'article_id', 'body', 'reply_time'];
}
