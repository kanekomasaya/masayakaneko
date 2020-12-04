<?php
session_start();
if(!$_SESSION) {
  // リダイレクト処理
  header( "Location: ./login.php" );
  exit; 
}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>投稿画面</title>
<link rel="stylesheet" type="text/css" href="css/post.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script>
$(function() {
  if($("input[type='submit']").click(function() {
    // 名称バリデーション////////////////////////////////////////////////////
    if($("input[name='fish']").val() == ""){
            alert('魚の名称を入力してください');
          return false;
    }

    // 場所バリデーション////////////////////////////////////////////////////
    if($("input[name='catch_at']").val() == ""){
            alert('釣った場所を入力してください');
          return false;
    }


    // 天気バリデーション////////////////////////////////////////////////////
    if($("input[name='catch_weather']").val() == ""){
            alert('釣った天気を入力してください');
          return false;
    }

    // 文字数チェックバリデーション//////////////////////////////////////////
    var txt = document.getElementById('fish');
    var count = txt.value.length;
    if (count > 20) {
             alert("魚の名称を20文字以内で入力してください");
             return false;
    }

    // 文字数チェックバリデーション//////////////////////////////////////////
    var txt = document.getElementById('catch_at');
    var count = txt.value.length;
    if (count > 20) {
             alert("釣った場所を20文字以内で入力してください");
             return false;
    }

    // 文字数チェックバリデーション//////////////////////////////////////////
    var txt = document.getElementById('catch_weather');
    var count = txt.value.length;
    if (count > 20) {
             alert("釣った天候を20文字以内で入力してください");
             return false;
    }

    // 画像バリデーション////////////////////////////////////////////////////
    if($("input[name='img']").val() == ""){
            alert('画像を選択してください');
          return false;
    }

    if (!ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
    	return true;
    }

    //アップロードを許可する拡張子
var allow_exts = new Array('jpg', 'jpeg', 'png');

//フォーム内容の確認をする関数
function checkForm()
{
	var files = document.getElementsByName('img')[0].files;
	//ファイルが選択されているか確認
	if (files.length == 0) {
		alert('ファイルを選択してください');
		return false;
	}
	//指定されたファイルの数だけ拡張子をチェックする
	for (var i = 0; i < files.length; i++) {
		if (!checkExt(files[i].name)) {
			alert(files[i].name+'はアップロードできません');
			return false;
		}
	}
	//チェックを通ったらtrueを返す
	return true;
}

//アップロード予定のファイル名の拡張子が許可されているか確認する関数
function checkExt(filename)
{
	//比較のため小文字にする
	var ext = getExt(filename).toLowerCase();
	//許可する拡張子の一覧(allow_exts)から対象の拡張子があるか確認する
	if (allow_exts.indexOf(ext) === -1) return false;
	return true;
}

//ファイル名から拡張子を取得する関数
function getExt(filename)
{
	var pos = filename.lastIndexOf('.');
	if (pos === -1) return '';
	return filename.slice(pos + 1);
}

  }));
})
</script>
</head>
<body>
  <?php
  require "header.php";
   ?>
  <section class="section1">
    <div class="section1_wrapper">
      <h1 class="fish">投稿をする</h1>
      <form class="" action="mypost.php" method="post" enctype="multipart/form-data">
        <div class="form_contents">
          <table>
            <tr>
              <th><i class="fas fa-fish"></i>釣った魚</th>
              <td><input type="text" name="fish" value="" id="fish"></td>
            </tr>
            <tr>
              <th><i class="fas fa-location-arrow"></i>場所</th>
              <td><input type="text" name="catch_at" value="" id="catch_at"></td>
            </tr>
              <input type="hidden" name="catch_time" value="" id="catch_time">
            <tr>
              <th><i class="fas fa-cloud-sun"></i>天候</th>
              <td><input type="text" name="catch_weather" value="" id="catch_weather"></td>
            </tr>
            <tr>
              <th><i class="fas fa-images"></i>画像</th>
              <td>
                <input type="file" name="img" value="100" id="img" accept="image/*">
              </td>
            </tr>
          </table>
        </div>
        <div class="submit">
          <input class="submit" type="submit" name="submit" class="button" value="この内容で投稿する" id="fileCheckBtn">
        </div>
      </form>
    </div>
  </section>
</body>
</html>
