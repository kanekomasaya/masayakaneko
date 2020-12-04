<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新規登録画面</title>
<link rel="stylesheet" type="text/css" href="css/newregi.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script>
  $(function() {
    // バリデーションチェック（JQuery）/////////////////////////////////////////////
  // 氏名欄バリデーションチェック//////////////////////////////////
  if($("input[type='submit']").click(function() {
    if($("input[name='name']").val() == ""){
    　　    alert('名前を入力してください');
            return false;
    }
　// カタカナ欄バリデーションチェック//////////////////////////////////
    if($("input[name='katakana']").val() == ""){
　      　    alert('フリガナをカタカナ文字で入力してください');
            return false;
　　  }
// パスワードバリデーションチェック////////////////////////////////
    if($("input[name='password']").val() == ""){
  　　　　　　　alert('パスワードを入力してください');
           　return false;
　　   }
// 電話番号バリデーションチェック//////////////////////////////////
    if($("input[name='tel']").val() == ""){
      　　　　　alert('電話番号を入力してください');
          　return false;
　　   }
　　　if(!$("input[name='tel']").val().match(/^[0-9]+$/)){
　　　　　　   alert('電話番号には数字のみを入力してください');
          　return false;
　　  }
// 住所バリデーションチェック////////////////////////////////
    if($("input[name='address']").val() == ""){
  　　　　　　　alert('住所を入力してください');
           　return false;
　　   }

// 文字数（名前）バリデーションチェック//////////////////////////////////
   var txt = document.getElementById('input1count');
   var count = txt.value.length;
   if (count > 10) {
            alert("氏名を10文字以内で入力してください");
            return false;
   }
// 文字数（カタカナ）バリデーションチェック//////////////////////////////////
　　　var txt = document.getElementById('input2count');
　　　var count = txt.value.length;
　　　if (count > 10) {
　　　       alert("フリガナを10文字以内で入力してください");
  　　　     return false;
　　　}
 }));
  })
</script>
</head>
<body>
  <section class="section1">
    <div class="section1_wrapper">　
      <div class="sec1_text">
        <div class="fish_box">
          <a href="login.php"><i class="fas fa-fish fa-3x fish fa-rotate-180"></i></a>
        </div>
        <h1 class="fish">会員登録</h1>
        <p class="need"　style="color: red;">※機能をご利用頂くには、新規登録が必要です。</p>
        <p class="please">各項目のご記入をお願い致します。</p>
        <h1 class="fish">基本情報</h1>
      </div>
      <div class="sec1_form">
        <form class="" action="newregiconf.php" method="post">
          <div class="form_contents">
            <label for="name">お名前</label><br><input id="input1count" type="text" name="name" class="entry"><br>
            <label for="katakana">カタカナ</label><br><input id="input2count" type="text" name="katakana" class="entry"><br>
            <label for="password">パスワード</label><br><input id="password" type="text" name="password" class="entry"><br>
            <label for="tel">電話番号</label><br><input id="tel" type="text" name="tel" class="entry"><br>
            <label for="address">住所</label><br><input id="address" type="text" name="address" class="entry"><br>
            <input type="submit" class="submit" value="この内容で確認する">
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
