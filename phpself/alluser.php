<?php
 session_start();

 require_once('config/config.php');
 require_once('model/User.php');

// ログイン画面を経由しているか確認
 if(($_SESSION['User']['roll'] != 1)) {
   header('Location: /phpself/login.php');
   exit;
 }
 /* データベースへ接続 */
 try {
 // MySQLへの接続
 $user = new User($host, $dbname, $user, $password);
 // 接続を使用する
 $user->connectDb();

 if(isset($_GET['del'])) {
     $user->userDel($_GET['del']);

}

$result = $user->allUser();

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
<title>全ユーザー一覧画面</title>
<link rel="stylesheet" type="text/css" href="css/alluser.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">
      <div class="sec1_text">
        <div class="fish_box">
          <i class="fas fa-fish fa-3x fish fa-rotate-180"></i>
        </div>
        <h1 class="fish">全ユーザー一覧画面</h1>
        IDを入力:<input id="id_number" type="number"><br>

<div id="result">
 <p>数値を入力してボタンを押してください。</p>
</div>
<button id="ajax">ボタン</button>

<script>
$(function(){

 $('#ajax').on('click',function(){

  $.ajax({
   url:'ajax.php', //送信先
   type:'POST', //送信方法
   datatype: 'json', //受け取りデータの種類
   data:{
    'id' : $('#id_number').val()
   }
   })
   // Ajax通信が成功した時
   .done( function(data) {
   $('#result').html("<p>ID番号"+data[0].id+"は「"+data[0].name+"」さんです。<br>カタカナは「"+data[0].katakana+"」です。</p>");
   console.log('通信成功');
   console.log(data);
   })
   // Ajax通信が失敗した時
   .fail( function(data) {
   $('#result').html(data);
   console.log('通信失敗');
   console.log(data);
   })
 }); //#ajax click end

}); //END
</script>
        <table>
          <tr>
          <th>ID</th>
          <th>NAME</th>
          <th>KATAKANA</th>
          <th>PASSWORD</th>
          <th>TEL</th>
          <th>ADDRESS</th>
        </tr>
        <?php foreach($result as $row): ?>
        <tr><form class="" action="" method="post">
                <td>
                  <?=$row['id']?>
                </td>

                <td>
                <?=$row['name']?>
                </td>

                <td>
                <?=$row['katakana']?>
                </td>

                <td>
                <?=$row['password']?>
                </td>

                <td>
                <?=$row['tel']?>
                </td>

                <td>
                <?=$row['address']?>
                </td>

                <td>
                  <a href="?del=<?=$row['id']?>" onclick="if(!confirm('ID:<?=$row['id']?>削除しますがよろしいですか？')) return false">削除</a>
                </td>
                </form></tr>
        <?php endforeach; ?>
        </table>
      </div>
      <div class="back_login">
        <p><a href="login.php">ログイン画面に戻る</a></p>
      </div>
    </div>
  </section>
</body>
</html>
