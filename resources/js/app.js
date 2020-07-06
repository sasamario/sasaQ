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
        langPrefix: '',
        breaks : true,
        sanitize: true,
        gfm: true,
    });

    $('#markdown_editor_textarea').keyup(function() { //keyup()イベントは、押されたキーを話すとイベント発生
        var html = marked(getHtml($(this).val())); //入力された値をval()で取得　marked()でマークダウン文字列をHTMLに変換
        $('#markdown_preview').html(html); //markdown_previewのhtml要素の書き換え
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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
