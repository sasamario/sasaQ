@section('help-modal')
    {{--ヘルプモーダル--}}
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLongTitle">マークダウン記法の詳しい説明</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ※注意！「#」の後ろは半角スペース１つ入れること！<br/>
                    <strong>【見出し】</strong><br/>
                    # 見出し１<br/>
                    ## 見出し２<br/>
                    ### 見出し３<br/>
                    <strong>【リスト】</strong><br/>
                    [ - ]、[ + ]、[ * ]のいずれかで箇条書きリストを記述可能<br/>
                    - リスト１<br/>
                    　- ネスト リスト1_1<br/>
                    　　- ネスト リスト1_1_1<br/>
                    <strong>【番号付きリスト】</strong><br/>
                    1. 番号付きリスト１<br/>
                    　1.番号付きリスト1_1<br/>
                    　1.番号付きリスト1_2<br/>
                    <strong>【引用】</strong><br/>
                    > 引用文<br/>
                    <strong>【二重引用】</strong><br/>
                    >> 引用文<br/>
                    <strong>【code記法】</strong><br/>
                    `
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection