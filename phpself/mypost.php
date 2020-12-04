<?php
  require_once('config/config.php');
  require_once('model/User.php');
  session_start();

  if(!$_SESSION) {
    header( "Location: ./login.php" );
    exit;
  }
  /* データベースへ接続 */
try {
  // MySQLへの接続
  $user = new User($host, $dbname, $user, $password);
  // 接続を使用する
  $user->connectDb();
  if(isset($_GET['del'])) {
     $user->delete($_GET['del']);
  }
    // 登録処理
  else {
        // 登録処理
          if($_POST) {
              $user->add($_POST);
            }
      }
        // 参照処理
         $result = $user->findAll();
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
<title>自分の投稿一覧</title>
<link rel="stylesheet" type="text/css" href="css/mypost.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <?php
  require "header.php";
   ?>
  <section class="section1">
    <div class="section1_wrapper">
      <h1><?=$_SESSION['User']['name']?>さんの投稿一覧</h1>
      <div class="sec1_table">
         <?php if($result): ?>
           <table>
          <?php foreach((array)$result as $row): ?>
          <tr>
            <td>釣りあげたお魚<br><?='<p class="lightblue">'.$row['fish'].'</p>'?></td>
            <td>釣りあげた場所<br><?='<p class="lightblue">'.$row['catch_at'].'</p>'?></td>
            <td>釣りあげた日<br><?='<p class="lightblue">'.$row['catch_time'].'</p>'?></td>
            <td>釣りあげた天候<br><?='<p class="lightblue">'.$row['catch_weather'].'</p>'?></td>
            <td>今日の一枚<br><?='<p class="lightblue">'.$row['img'].'</p>'?></td>
            <td>
              <a href="?del=<?=$row['0']?>" onclick="if(!confirm('ID:<?=$row['0']?>削除しますよろしいですか？')) return false">削除</a>
            </td>
          </tr>
          <?php endforeach; ?>
          </table>
         <?php endif; ?>
          <?php if(!$result): ?>
            <p class="alert">※現在、<?=$_SESSION['User']['name']?>さんの投稿がありません。<br>「<i class="fas fa-blog"></i>投稿する」ボタンから投稿をしましょう。</p>
          <?php endif; ?>
      </div>
    </div>
  </section>
</body>
</html>
