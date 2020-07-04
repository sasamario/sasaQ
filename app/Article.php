<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $primaryKey = 'article_id';

  protected $fillable = ['user_id', 'title', 'tag1', 'tag2', 'tag3', 'body', 'date'];
}
