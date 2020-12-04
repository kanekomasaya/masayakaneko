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

  if(!$_SESSION) {
    // リダイレクト処理
    header( "Location: ./login.php" );
    exit;
  }

  $result = $user->searchAll();
  $myUser = $_SESSION['User']['name'];

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
<title>検索結果一覧</title>
<link rel="stylesheet" type="text/css" href="css/searchresult.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script>
const timer = 6000   // ミリ秒で間隔の時間を指定
window.addEventListener('load',function(){
  setInterval('location.reload()',timer);
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
        <?php if($myUser == $result[0]['name']) {
          print '<h1 style ="margin-top: 200px;">'.'※ご自身の友達追加は出来ません。<br>ほかの友人を探しましょう。'.'</h1>';
        }
         ?>
       <?php if($myUser != $result[0]['name']): ?>
        <h3>ヒットしたユーザー</h3>
      </div>
      <table>
        <tr>
          <th>お名前</th>
          <th>カタカナ名</th>
        </tr>
         <?php foreach((array)$result as $row): ?>
         <tr>
           <td><?=$row['name']?></td>
           <td><?=$row['katakana']?></td>
           <td><a href="favorite.php?favorite=<?=$row['id']?>">お気に入りに追加する</a></td>
         </tr>
       <?php endforeach; ?>
     <?php endif; ?>
      </table>
    </div>
  </section>
</body>
</html>
