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

if(isset($_GET['edit'])) {
      //編集処理
          if($_POST) {
            $message = $user->validate($_POST);
              if(empty($message['name']) && empty($message['katakana']) && empty($message['password']) && empty($message['tel']) && empty($message['address'])) {
                 $user->edit($_POST);
              }
            }
            //　参照処理
          $result['User'] = $user->findById($_GET['edit']);
          // 削除処理
        } else {

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
<title>設定変更</title>
<link rel="stylesheet" type="text/css" href="css/setchange.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <script>
  $(function() {
     const hum = $('#hamburger, .close')
     const nav = $('.sp-nav')
     hum.on('click', function(){
        nav.toggleClass('toggle');
     });
  });
  </script>
</head>
<body>
  <header>
    <div class="header_name">
      <p><a href="toppage.php"><i class="fas fa-fish fish fa-rotate-180"></i>Fishing Board</a></p>
    </div>
    <div class="header_contents">
      <p><a href="favorite.php" class="nav-list"><i class="fas fa-thumbs-up thumbs"></i>お気に入り</a></p>
      <p><a href="mypost.php" class="nav-list"><i class="fas fa-th-list"></i>マイポスト</a></p>
      <p><a href="post.php" class="nav-list"><i class="fas fa-blog"></i></i>投稿する</a></p>
      <p><a href="search.php" class="nav-list"><i class="fas fa-search"></i>友達検索</a></p>
      <p><a href="setchange.php?edit=<?=$_SESSION['User']['id']?>" class="nav-list"><i class="fas fa-cogs"></i>設定変更</a></p>
      <p><a href="logout.php" class="nav-list"><i class="fas fa-sign-out-alt"></i>ログアウトする</a></p>
    </div>
    <nav class="sp-nav">
      <ul>
         <li><a href="favorite.php">お気に入り</a></li>
         <li><a href="mypost.php">マイポスト</a></li>
         <li><a href="post.php">投稿する</a></li>
         <li><a href="search.php">友達検索</a></li>
         <li><a href="setchange.php?edit=<?=$_SESSION['User']['id']?>">設定変更</a></li>
         <li><a href="logout.php">ログアウトする</a></li>
        <li class="close"><span>閉じる</span></li>
      </ul>
    </nav>
    <div id="hamburger">
         <span></span>
   </div>
  </header>
  <section class="section1">
    <div class="section1_wrapper">
      <h1>個人情報設定変更</h1>
      <h2 style="color: red;">変更する情報を下記に記載してください。</h2>
    </div>
    <div class="sec1_form">
      <form class="" action="" method="post">
        <div class="form_contents">
          <form class="" action="" method="post">
            <?php if(isset($message['name'])) print '<p class="error">'.$message['name'].'</p>'?>
            <?php if(isset($message['katakana'])) print '<p class="error">'.$message['katakana'].'</p>'?>
            <?php if(isset($message['tel'])) print '<p class="error">'.$message['tel'].'</p>'?>
            <?php if(isset($message['address'])) print '<p class="error">'.$message['address'].'</p>'?>
               <label id="name">ユーザー名 : <input type="text" name="name" value="<?php if(isset($result['User'])) print $result['User']['name'] ?>"></label><br><br>
               <label id="katakana">カタカナ : <input type="text" name="katakana" value="<?php if(isset($result['User'])) print $result['User']['katakana'] ?>"></label><br><br>
               <input type="hidden" name="password" value="<?php if(isset($result['User'])) print $result['User']['password'] ?>">
               <label id="mail">電話番号 : <input type="text" name="tel" value="<?php if(isset($result['User'])) print $result['User']['tel'] ?>"></label><br><br>
               <label id="contact">住所 : <input type="text" name="address" value="<?php if(isset($result['User'])) print $result['User']['address'] ?>"></label><br><br>
               <input type="hidden" name="id" value="<?php if(isset($result['User'])) print $result['User']['id'] ?>"><br>
               <input type="submit" name="submit" value="この情報で確定する">
               <a class="change" href="setchangeconf.php?confirm=<?=$_SESSION['User']['id']?>">変更された情報を確認する</a>
         </form>
      </form>
    </div>
  </section>
</body>
</html>
