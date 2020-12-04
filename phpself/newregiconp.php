<?php
require_once('config/config.php');
require_once('model/User.php');



/* データベースへ接続 */
try {
// MySQLへの接続
$user = new User($host, $dbname, $user, $password);
// 接続を使用する
$user->connectDb();
$result = $user->addUser($_POST);

if($_POST) {
  $name = htmlspecialchars( $_POST[ 'name' ], ENT_QUOTES, 'UTF-8' );
  $katakana = htmlspecialchars( $_POST[ 'katakana' ], ENT_QUOTES, 'UTF-8' );
  $password = htmlspecialchars( $_POST[ 'password' ], ENT_QUOTES, 'UTF-8' );
  $tel = htmlspecialchars( $_POST[ 'tel' ], ENT_QUOTES, 'UTF-8' );
  $address = htmlspecialchars( $_POST[ 'address' ], ENT_QUOTES, 'UTF-8' );
} else {
  // リダイレクト処理
  header( "Location: ./newregi.php" );
  exit;
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
<title>新規登録完了画面</title>
<link rel="stylesheet" type="text/css" href="css/newregiconp.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="sec1_text">
        <div class="fish_box">
          <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        </div>
        <h1 class="fish">新規登録完了画面</h1>
        <h2>新規登録が完了致しました。</h2>
        <h2><span class="red">ログイン画面に戻る</span>を押してログイン画面から</h2>
        <h2>ログインしてください。</h2>
      </div>
      <div class="back_login">
        <p><a href="login.php">ログイン画面に戻る</a></p>
        <form class="" action="login.php" method="post">
          <input type="hidden" name="name" value="<?php print $name;?>">
          <input type="hidden" name="katakana" value="<?php print $katakana;?>">
          <input type="hidden" name="password" value="<?php print $password;?>">
          <input type="hidden" name="tel" value="<?php print $tel;?>">
          <input type="hidden" name="address" value="<?php print $address;?>">
        </form>
      </div>
    </div>
  </section>
</body>
</html>
