<?php
  require_once('config/config.php');
  require_once('model/User.php');
  session_start();
  if(!$_SESSION) {
    // リダイレクト処理
    header( "Location: ./login.php" ) ;
    exit ;
  }
  /* データベースへ接続 */
try {
  // MySQLへの接続
  $user = new User($host, $dbname, $user, $password);
  // 接続を使用する
  $user->connectDb();
  if(isset($_GET['release'])) {
     $user->release($_GET['release']);
  }

if(isset($_GET['favorite'])) {
  $user->favoriteAdd();
  $result = $user->favoriteAll();
} else {
  $result = $user->favoriteAll();
}


//該当しなかったら実行しない
} catch (PDOException $e){
    echo $e->getMessage();
    exit;
}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>お気に入り一覧</title>
<link rel="stylesheet" type="text/css" href="css/favorite.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <?php
  require "header.php";
   ?>
  <section class="section1">
    <div class="section1_wrapper">
      <h1>こちらはお気に入り登録者の投稿一覧画面です。</h1>
    <?php if($result): ?>
    <table>
      <?php foreach((array)$result as $row): ?>
      <tr>
        <th><?='<i class="fas fa-user-friends"></i>'.$row['catch_who']?></th>
        <td>本日釣りあげたお魚:<br><?='<p class="blue">'.'<i class="fas fa-fish fish fa-rotate-180"></i>'.$row['fish'].'</p>'?></td>
        <td>釣りあげた場所:<br><?='<p class="blue">'.'<i class="fas fa-location-arrow"></i>'.$row['catch_at'].'</p>'?></td>
        <td>釣りあげた時間:<br><?='<p class="blue">'.'<i class="fas fa-stopwatch"></i>'.$row['catch_time'].'</p>'?></td>
        <td>釣りあげた天候:<br><?='<p class="blue">'.'<i class="fas fa-cloud-sun"></i>'.$row['catch_weather'].'</p>'?></td>
        <td>今日の一枚<br><?=$row['img']?></td>
        <td><a href="?release=<?=$row['1']?>" onclick="if(!confirm('user_id:<?=$row['1']?>この投稿をしたユーザーの友達登録を解除しますがよろしいですか？')) return false">友達登録を解除</a></td>
      </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
    <?php if(!$result): ?>
      <p class="alert">※現在、<?=$_SESSION['User']['name']?>さんのお気に入り登録がありません。<br>また、友達登録したユーザーの投稿がありません。<br>「<i class="fas fa-search"></i>友達検索」ボタンから友達を探しましょう。</p>
    <?php endif; ?>
    </div>
  </section>
</body>
</html>
