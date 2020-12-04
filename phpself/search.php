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
<title>検索</title>
<link rel="stylesheet" type="text/css" href="css/search.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <?php
  require "header.php";
   ?>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="catchcopy">
        <h2>お気に入り登録する友達を見つけよう!!</h2>
      </div>
      <div class="search">
        <form action="searchresult.php" method="post">
            <div class="form">
              友達検索<br><input type="text" name="keywords" class="name" placeholder="キーワード検索">
              <input type="submit" class="submit" value="検索">
            </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
