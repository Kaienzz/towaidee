<?php
/**
 * Simple Machines Forum (SMF)
 *
 * サイドバー用のテンプレート
 *
 * このテンプレートでは、右側にサイト紹介やリンク一覧などのコンテンツを表示します。
 */

function template_sidebar()
{
    echo '
    <aside id="sidebar">
        <div id="introduction_box">
            <div class="inner">
                <h2>サイドバー</h2>
                <p>ここにサイドバー用のコンテンツ（サイト紹介等）を表示します。</p>
                <ul>
                    <li><a href="#">リンク1</a></li>
                    <li><a href="#">リンク2</a></li>
                    <li><a href="#">リンク3</a></li>
                </ul>
            </div>
        </div>
    </aside>';
}
?>