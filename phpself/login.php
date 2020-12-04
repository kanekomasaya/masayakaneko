<?php
session_start();


require_once('config/config.php');
require_once('model/User.php');

/* データベースへ接続 */
try {
// MySQLへの接続
$user = new User($host, $dbname, $user, $password);
// 接続を使用する
$user->connectDb();

if($_POST) {
  $result = $user->login($_POST);
  if(password_verify($_POST['password'], $result['password'])){
    if(!empty($result)) {
       $_SESSION['User'] = $result;
       if($_SESSION['User']['roll'] == 1) {
         header('Location: /phpself/alluser.php');
         exit;
       } elseif($_SESSION['User']['roll'] != 1) {
         header('Location: /phpself/toppage.php');
         exit;
       }
    }
    }else{
        echo "ログイン認証に失敗しました";
    }
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
<title>ログイン</title>
<link rel="stylesheet" type="text/css" href="css/login.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="section1_text">
        <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        <h1>釣り情報掲示板ログイン</h1>
      </div>
      <div class="form_wrapper">
        <form class="" action="" method="post">
          <p class="login">※ログインするには以下にユーザー情報を入力してください。</p>
          <div class="form_contents">
            <?php if(isset($message)) print "<P class='error'>".$message['name']."</p>" ?>
            <label for="name">お名前</label><br><input id="name" type="text" name="name" class="entry">
          </div>
          <div class="form_contents"><br>
            <?php if(isset($message)) print "<P class='error'>".$message['password']."</p>" ?>
            <label for="password">パスワード</label><br><input id="password" type="password" name="password" class="entry">
          </div>
          <div class="form_login"><br>
            <input type="submit" name="" value="ログイン">
          </div>
        </form>
        <div class="section1_text">
          <p>登録されていない場合は<span class="new">新規登録へ</span>をクリック↓</p>
        </div>
        <p><a href="newregi.php" class="new">新規登録へ</a></p><br><br>
        <p><a href="passreset.php">パスワードを忘れた方はこちらへ</a></p>
      </div>
    </div>
  </section>
</body>
</html>
