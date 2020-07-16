<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $primaryKey = 'article_id';

  protected $fillable = ['user_id', 'title', 'tag1', 'tag2', 'tag3', 'body', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  public function replies()
  {
      //Articleモデルでは、主キーをidではなくarticle_idと設定している。親モデルの主キー名がidでない場合、第三引数で指定する必要がある！
      return $this->hasMany('App\Reply', 'article_id', 'article_id');
  }
}
