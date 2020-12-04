<?php

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




    if ($_POST) {
  // バリデーション（PHP）///////////////////////////////////////////
// 氏名欄バリデーションチェック//////////////////////////////////
  if (empty($_POST["name"])) {
        print '<h3 style="color: red;">'.'※お名前を入力してください'.'</h3>';
        print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
        return false;
   }
   // カタカナ欄バリデーションチェック//////////////////////////////////
   if (empty($_POST["katakana"])) {
     print '<h3 style="color: red;">'.'※カタカナを入力してください'.'</h3>';
     print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
        return false;
    }
    // 電話番号バリデーションチェック//////////////////////////////////
    if (!preg_match('/^[0-9]+$/', $_POST["tel"])) {
      print '<h3 style="color: red;">'.'※電話番号は数字のみで入力してください'.'</h3>';
      print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
          return false;
    }

    if (empty($_POST["tel"])) {
      print '<h3 style="color: red;">'.'※電話番号を入力してください'.'</h3>';
      print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
         return false;
     }
    // パスワードバリデーションチェック//////////////////////////////////
    if (empty($_POST["password"])) {
      print '<h3 style="color: red;">'.'※パスワードを入力してください'.'</h3>';
      print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
         return false;
     }
     // 住所バリデーションチェック//////////////////////////////////
     if (empty($_POST["address"])) {
       print '<h3 style="color: red;">'.'※住所を入力してください'.'</h3>';
       print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
          return false;
      }
  // 文字数（名前）バリデーションチェック//////////////////////////////////
  if (mb_strlen($_POST["name"]) > 10) {
    print '<h3 style="color: red;">'.'※氏名は10文字以内で入力してください'.'</h3>';
    print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
          return false;
    }
  // 文字数（カタカナ）バリデーションチェック//////////////////////////////////
  if (mb_strlen($_POST["katakana"]) > 10) {
    print '<h3 style="color: red;">'.'※カタカナは10文字以内で入力してください'.'</h3>';
    print '<a href="newregi.php">'.'新規登録画面に戻る'.'</a>';
          return false;
    }

}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新規登録確認画面</title>
<link rel="stylesheet" type="text/css" href="css/newregiconf.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="sec1_text">
        <div class="fish_box">
          <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        </div>
        <h1 class="fish">新規登録確認画面</h1>
        <h2>下記の情報で新規登録を行いますが、よろしいですか？</h2>
      </div>
      <div class="sec1_form">
        <form class="" action="newregiconp.php" method="post">
             <?php
             print '氏名:'.htmlspecialchars($name, ENT_QUOTES, 'UTF-8').'<br><br>';
             print 'カタカナ:'.htmlspecialchars($katakana, ENT_QUOTES, 'UTF-8').'<br><br>';
             print 'パスワード:'.htmlspecialchars($password, ENT_QUOTES, 'UTF-8').'<br><br>';
             print '電話番号:'.htmlspecialchars($tel, ENT_QUOTES, 'UTF-8').'<br><br>';
             print '住所:'.htmlspecialchars($address, ENT_QUOTES, 'UTF-8').'<br><br>';
             ?>
             <input type="hidden" name="name" value="<?php print $name;?>">
             <input type="hidden" name="katakana" value="<?php print $katakana;?>">
             <input type="hidden" name="password" value="<?php print $password;?>">
             <input type="hidden" name="tel" value="<?php print $tel;?>">
             <input type="hidden" name="address" value="<?php print $address;?>">
            <input type="submit" class="submit" value="この内容で確定する">
        </form>
      </div>
    </div>
  </section>
</body>
</html>
