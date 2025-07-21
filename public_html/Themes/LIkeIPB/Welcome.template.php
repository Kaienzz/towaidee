<?php
// if (!defined('SMF'))
//     die('Hacking attempt...');

/*
 * サイト紹介 BOX を表示するテンプレート関数（掲示板のカテゴリ部分のデザインに合わせる）
 */
function template_welcome_box()
{
    echo '
    <!-- <div id="introduction_box" class="windowbg"> -->
    <div id="introduction_box">
        <div class="cat_bar">
            <h3 class="catbg">บอร์ดล่าม/ผู้เรียนภาษา งานภาษาญี่ปุ่น งานภาษาเกาหลี งานภาษาจีน</h3>
        </div>
        <div class="inner" style="background-color: #ECF0F4; padding: 15px;">
            <div style="background-color: #FFFFFF; padding: 15px;">
                <p>โตไวดี เว็บบอร์ดล่ามและผู้เรียนภาษาญี่ปุ่น-เกาหลี-จีน ประกาศงานภาษาญี่ปุ่น งานภาษาจีน งานภาษาเกาหลี หรือแลกเปลี่ยนความรู้สำหรับล่ามและผู้ที่ใช้ภาษาญี่ปุ่น เกาหลี จีน ในการทำงาน ล่าม นักแปล ครูสอนภาษา รวมถึงพูดคุยเกี่ยวกับท่องเที่ยว/ทัวร์ญี่ปุ่น-เกาหลี-จีน</p>
            </div>
        </div>
    </div>';
}
?>