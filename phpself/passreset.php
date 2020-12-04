<?php
require_once('config/config.php');
require_once('model/User.php');
/* データベースへ接続 */
try {
// MySQLへの接続
$user = new User($host, $dbname, $user, $password);
// 接続を使用する
$user->connectDb();
if($_POST) {
  print_r($_POST);
  if($_POST['new_password'] == $_POST['password'] ) {
    $user->passreset($_POST);
    $message = '<p style="color: red">'.'変更が完了致しました。'.'</p>';
  }
  if($_POST['new_password'] != $_POST['password'] ) {
    $message = '<p style="color: red">'.'※確認用のパスワードと一致しません。。'.'</p>';
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
<title>パスワードリセット</title>
<link rel="stylesheet" type="text/css" href="css/passreset.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="section1_text">
        <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        <h1>パスワードリセット画面</h1>
      </div>
      <form class="" action="" method="post">
        <div class="row">
            <div class="col-lg-12">
              <label class="control-label">お名前</label>
            </div>
          </div>
            <div class="col-lg-12">
              <input class="form-control" name="name" type="name" placeholder="Your Name" required>
            </div>
          <div class="row">
            <div class="col-lg-12">
              <label class="control-label">新しいパスワード</label>
            </div>
          </div>
            <div class="col-lg-12">
              <input class="form-control" name="new_password" type="password" placeholder="New Password" required>
            </div>
          <div class="row">
            <div class="col-lg-12">
              <label class="control-label">再入力</label>
            </div>
          </div>
            <div class="col-lg-12">
              <input class="form-control" name="password" type="password" placeholder="Re-type New Password" required>
            </div>
          <div class="row">
            <div class="col-lg-12">
              <button class="btn btn-success btn-block" name="submit" style="margin-top:8px;">送信する</button>
            </div>
            <?php if(isset($message)) print $message;?>
          </div>
      </form>
      <p><a href="login.php">ログイン画面へ</a></p>
    </div>
  </section>
</body>
</html>
