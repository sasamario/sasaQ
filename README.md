# リポジトリ詳細
アプリ名：【sasaQ】<br/>
sasaQは、社内向け質問サイトです。

社会人として働いてみて感じたことは、「質問の仕方」の重要性です。
今年（2020年）は、新型コロナウイルスの影響もあり在宅勤務中心でしたので質問する際は、チャットが主でした。
文章だけでは、なかなか自分の考えを伝えられないと感じました。GitHub上で、マークダウン記法を用いて質問を行うようになってから
質問の取りまとめがしやすくなり、自分の考えが伝えられるようになりました。
そこで、マークダウンが使える質問サイトを開発してみようと思いsasaQを開発しました。

また、社内向けを想定した理由としては、実際に働いてみて社内で複数の人から同じ質問をされたことがある方が結構いそうだなと感じたからです。
（例えば、毎年新卒が同じような質問をするなど）
そこで、社内向けの質問サービスがあれば質問や回答がデータとして蓄積していくため、回答者の負担を減らすことが出来ると考えたからです。

# デモ動画
[デモ１](https://raw.githubusercontent.com/wiki/sasamario/sasaQ/images/sasaQdemo1.gif)
[デモ２](https://raw.githubusercontent.com/wiki/sasamario/sasaQ/images/sasaQdemo2.gif)
[デモ３](https://raw.githubusercontent.com/wiki/sasamario/sasaQ/images/sasaQdemo3.gif)

Slack通知機能時![sasaQslack](https://user-images.githubusercontent.com/43754736/96087690-3a26c200-0eff-11eb-89ae-cc74191348f3.PNG)
# 使用言語/フレームワーク/ライブラリ
- PHP:7.3.18
- Laravel:7.20.0
- JavaScript
- Vue.js:2.5.17
- jQuery:3.5.1
- bootstrap4
- marked.js

# 実装済み機能
- ログイン機能
- Twitterログイン
- Googleログイン
- ゲストログイン
- CRUD機能【記事（質問）・コメント】
- 記事投稿画面でのプレビュー機能
- ブックマーク機能
- 下書き保存機能
- Slack通知機能（記事、コメント投稿時）
- 検索機能
- タグ検索機能
- ページネーション機能
- ヘルプモーダル
- 機能テスト（PHPUnit）
- プロフィール画像アップロード機能（AWS S3）
- 画像アップロード時のプレビュー機能



