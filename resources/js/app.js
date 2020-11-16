/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import marked from 'marked';

// マークダウンをプレビュー画面に表示する
$(function() {
    marked.setOptions({
        langPrefix: '', // code要素にdefaultで付くlangage-を削除 codeタグのクラス名の接頭辞に関するオプション
        breaks : true, //改行オプション これをtrueにすることで改行が反映される
        sanitize: true, //サニタイズ処理のオプション　これがないと攻撃的なスクリプトを実行されてしまう
        //コード部分にハイライトを適応させる
        highlight: function (code, lang) {
            return hljs.highlightAuto(code, [lang]).value
        }
    });

    //テンプレート文章を表示する
    $('#template').click(function() {
        const templateBody = (
            "# 結論\n" +
            "例）〇〇について分からなかった点がありますのでご教授お願いいたします。\n" +
            "例）〇〇のエラーが解決できていない状態ですのでアドバイスをいただきたいです。\n\n" +
            "# やったこと・調べたこと\n" +
            "例）Qiitaの〇〇という記事を参考に、△△を行いました。\n" +
            "例）30分程、公式ドキュメントや書籍で△△エラーについて調べました。\n\n" +
            "# 自分の考え\n" +
            "例）△△を行ったが解決できなかったため、〇□にミスがあるのではないかと考えています。\n\n" +
            "お手すきにご対応お願いいたします。"
        );

        $('#markdown_editor_textarea').focus().val($('#markdown_editor_textarea').val() + templateBody);

        let markedTemplate = marked(templateBody);
        $('#markdown_preview').html($('#markdown_preview').html() + markedTemplate);
    });

    $('#markdown_editor_textarea').keyup(function() { //keyup()イベントは、押されたキーを話すとイベント発生
        let html = marked(getHtml($(this).val())); //入力された値をval()で取得　marked()でマークダウン文字列をHTMLタグに変換
        $('#markdown_preview').html(html); //markdown_previewのhtml要素の書き換え
    });

    // 個別の記事画面のマークダウン文字列をHTMLタグに変換する
    let target = $('.article-body');
    let html = marked(getHtml(target.html()));
    target.html(html);

    //コメント欄のコメントのマークダウン文字列をHTMLタグに変換
    $('.reply-comment').each(function(index, element) {
       let replyComment = $(element).html();
       let replyCommentHtml = marked(getHtml(replyComment));
       $(element).html(replyCommentHtml);
    });

    // HTMLでは、比較演算子が &lt; 等になるのでreplace関数で置換を行う　
    function getHtml(html) {
        html = html.replace(/&lt;/g, '<');
        html = html.replace(/&gt;/g, '>');
        html = html.replace(/&amp;/g, '&');
        return html;
    }
});

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//コンポーネントとタグの紐付け
Vue.component('bookmark-component', require('./components/BookmarkComponent.vue').default);
Vue.component('profile-image-preview-component', require('./components/ProfileImagePreviewComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
})
