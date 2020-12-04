<?php
session_start();
if(!$_SESSION) {
  // リダイレクト処理
  header( "Location: ./login.php" );
  exit;
}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>トップページ</title>
<link rel="stylesheet" type="text/css" href="css/toppage.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.bgswitcher.js"></script>
    <script>
        jQuery(function($) {
    $('.section1').bgSwitcher({
        images: ['img/27143.webp', 'img/Aland_Islands_fishing-1024x576.jpg', 'img/2a3e894f96e898c1419e73fd6c16be98_t.jpeg', 'img/Valentines-Fish-Web-Banner.jpg', 'img/Bass-Fishing-Lures.jpg'], // 切り替え画像
        interval: 3000, //切り替えの間隔 1000=1秒
        start: true, //$.fn.bgswitcher(config)をコールした時に切り替えを開始する
        loop: true, //切り替えをループする
        shuffle: true, //背景画像の順番をシャッフルする
        effect: "slide", //エフェクトの種類 "fade" "blind" "clip" "slide" "drop" "hide"
        duration: 1000, //エフェクトの時間 1000=1秒
        easing: "linear", //エフェクトのイージング "swing" "linear"
    });
});
    </script>
</head>
<body>
  <?php
  require "header.php";
   ?>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="catchcopy">
        <h3>魚が人を繋げる</h3>
      </div>
      <div class="site_detail">
        <p>わざわざ友達を誘う必要はありません。<br>わざわざ何が釣れているのか聞く必要はありません。<br>欲しい情報が手に入ります。</p>
      </div>
    </div>
  </section>
</body>
</html>
