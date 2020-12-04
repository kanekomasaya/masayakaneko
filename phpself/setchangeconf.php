<?php
 session_start();
 require_once('config/config.php');
 require_once('model/User.php');


 try {
   // MySQLへの接続
   $user = new User($host, $dbname, $user, $password);
   // 接続を使用する
   $user->connectDb();

   if(!$_SESSION) {
     // リダイレクト処理
     header( "Location: ./login.php" );
     exit;
   }

   $result[0] = $user->findById($_GET['confirm']);
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
<title>設定変更</title>
<link rel="stylesheet" type="text/css" href="css/setchangeconf.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="sec1_text">
        <div class="fish_box">
          <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        </div>
        <h1 class="fish">個人情報設定確認</h1>
      </div>
      <div class="sec1_form">
        <?php foreach((array)$result as $row): ?>
        <tr>
          <td>お名前<?='<p class="lightblue">'.$row['name'].'</p>'?></td>
          <td>カタカナ<?='<p class="lightblue">'.$row['katakana'].'</p>'?></td>
          <td>電話番号<?='<p class="lightblue">'.$row['tel'].'</p>'?></td>
          <td>住所<?='<p class="lightblue">'.$row['address'].'</p>'?></td>
          <div class="back">
            <a href="toppage.php">トップページへ戻る</a>
          </div>
        </tr>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</body>
</html>
