@section('help-modal')
    {{--ヘルプモーダル--}}
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLongTitle">マークダウン記法早見表</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ※注意！マーク(#,-,>等)の後ろは半角スペース１つ入れること！<br/>
                    <p><strong>【見出し】</strong><br/>
                    # 見出し１<br/>
                    ## 見出し２<br/>
                    ### 見出し３</p>

                    <p><strong>【リスト】</strong><br/>
                    [ - ]、[ + ]、[ * ]のいずれかで箇条書きリストを記述可能<br/>
                    - リスト１<br/>
                    　- ネスト リスト1_1<br/>
                    　　- ネスト リスト1_1_1</p>

                    <p><strong>【番号付きリスト】</strong><br/>
                    1. 番号付きリスト１<br/>
                    　1.番号付きリスト1_1<br/>
                        　1.番号付きリスト1_2</p>

                    <p><strong>【引用】</strong><br/>
                        例）> 引用文</p>

                    <p><strong>【二重引用】</strong><br/>
                        例）>> 引用文</p>

                    <p><strong>【code記法】</strong><br/>
                        例）`code`</p>

                    <p><strong>【強調:em】</strong><br/>
                    [ * ]or[ _ ]で囲うと強調され、見た目は斜体になります<br/>
                        例）*強調*</p>

                    <p><strong>【強調:strong】</strong><br/>
                    [ ** ]or[ __ ]で囲うと強調され、見た目は太字になります<br/>
                        例）**強調**</p>

                    <p><strong>【強調:em + strong】</strong><br/>
                    [ *** ]or[ ___ ]で囲うと強調され、見た目は斜体かつ太字になります<br/>
                        例）***強調***</p>

                    <p><strong>【水平線】</strong><br/>
                    [ --- ]or[ ___ ]or[ *** ]と３つ以上の連続で記述すると水平線になります<br/>
                        例）---</p>

                    <p><strong>【リンク】</strong><br/>
                        [表示文字](リンクURL)でリンクを記述できる<br/>
                        例）[Google](https://www.google.co.jp/)<br/>
                        また、URLを記載するだけでも自動的にリンクになる！</p>

                    <p><strong>【取り消し線】</strong><br/>
                        [ ~~ ]で囲むことで取り消し線になる<br/>
                        例）~~取り消したい~~</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection