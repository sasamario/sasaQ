<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $primaryKey = 'article_id';

  protected $fillable = ['user_id', 'title', 'tag1', 'tag2', 'tag3', 'body', 'date', 'status', 'importance'];

  //下書き
  const STATUS_DRAFT = 0;

  //投稿
  const STATUS_POST = 1;

  //お手すき
  const STATUS_NOT_HURRY = 0;

  //急ぎ
  const STATUS_HURRY = 1;

  //その他
  const STATUS_OTHER = 2;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  public function replies()
  {
      //Articleモデルでは、主キーをidではなくarticle_idと設定している。親モデルの主キー名がidでない場合、第三引数で指定する必要がある！
      return $this->hasMany('App\Reply', 'article_id', 'article_id');
  }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
  public function user()
  {
      return $this->belongsTo('App\User');
  }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  public function bookmarks()
  {
      return $this->hasMany('App\Bookmark', 'article_id', 'article_id');
  }
}
