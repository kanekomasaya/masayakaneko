<?php
require_once('DB.php');

class User extends DB {
  // 参照 select
  public function findAll() {
    $sql = 'SELECT * FROM fish f JOIN user u ON u.id = f.user_id WHERE user_id = :id ORDER BY catch_time DESC;';
      $stmt = $this->con->prepare($sql);
      $params = array(':id'=>$_SESSION['User']['id']);
      $stmt->execute($params);
      $result = $stmt->fetchAll();
      return $result;
  }

// 検索機能　
  public function searchAll() {
    $sql = " SELECT * FROM user WHERE name like ? ";
    $stmt = $this->con->prepare($sql);
    $stmt->execute(array('%'. $_POST['keywords']. '%'));
    $result = $stmt->fetchAll();
    return $result;
 }

 // 登録(魚)　insert
  public function add($arr) {
    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
	     if (!file_exists('upload')) {
            mkdir('upload');
       }
       $file = 'upload/'.basename($_FILES['img']['name']);
       if (move_uploaded_file($_FILES["img"]["tmp_name"], $file)) {
        $img = '<img src="'.$file.'">';

        list($width, $hight) = getimagesize($file); // 元の画像名を指定してサイズを取得
        $baseImage = imagecreatefromjpeg($file); // 元の画像から新しい画像を作る準備
        $image = imagecreatetruecolor(300, 200); // サイズを指定して新しい画像のキャンバスを作成

        // 画像のコピーと伸縮
        imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 300, 200, $width, $hight);

        // リソースをバイナリへ変換する
        ob_start();
        imagejpeg($image);
        $img = ob_get_contents();
        ob_end_clean();

        $newImg = '<img src="data:images/jpeg;base64,'.base64_encode($img).'" />';
       }
    } else {
    	echo "ファイルが選択されていません。";
    }

    $sql = " INSERT INTO fish(user_id, catch_who, fish, catch_at, catch_time, catch_weather, img) VALUES(:user_id, :catch_who, :fish, :catch_at, now(), :catch_weather, :img) ";
    $stmt = $this->con->prepare($sql);
    $params = array(':user_id'=>$_SESSION['User']['id'], ':catch_who'=>$_SESSION['User']['name'], ':fish'=>$arr['fish'], ':catch_at'=>$arr['catch_at'], ':catch_weather'=>$arr['catch_weather'], ':img'=>$newImg);
    $stmt->execute($params);
}

    // 削除　delete
public function delete($id = null) {
  if(isset($id)) {
    $sql = "DELETE FROM fish WHERE id = :id";
    $stmt = $this->con->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);
  }
}

// 友達解除　delete
public function release($id = null) {
if(isset($id)) {
$sql = "DELETE FROM favorite WHERE user_id = :user_id and liked_id = :liked_id";
$stmt = $this->con->prepare($sql);
$params = array(':user_id'=>$_SESSION['User']['id'], ':liked_id'=>$id);
$stmt->execute($params);
}
}

    // 登録(魚)　insert
  public function addUser($arr) {
    $sql = " INSERT INTO user(name, katakana, password, tel, address) VALUES(:name, :katakana, :password, :tel, :address) ";
    $stmt = $this->con->prepare($sql);
    $params = array(':name'=>$arr['name'], ':katakana'=>$arr['katakana'], ':password'=>password_hash($arr['password'], PASSWORD_DEFAULT), ':tel'=>$arr['tel'], ':address'=>$arr['address']);
    $stmt->execute($params);
}

    // ログイン
  public function login($arr) {
    $sql = " SELECT * FROM user WHERE name = :name ";
    $stmt = $this->con->prepare($sql);
    $params = array(':name'=>$arr['name']);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
  }

  // 参照(全ユーザーの参照)
  public function allUser() {
    $sql = 'SELECT * FROM user';
      $stmt = $this->con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
  }

  // 削除（指定全ユーザー）
public function userDel($id = null) {
  if(isset($id)) {
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = $this->con->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);
  }
}

// 編集　update
public function edit($arr) {
 $sql = "UPDATE user SET name = :name, katakana = :katakana, tel = :tel, address = :address WHERE id = :id";
 $stmt = $this->con->prepare($sql);
 $params = array(':id'=>$_POST['id'], ':name'=>$_POST['name'], ':katakana'=>$_POST['katakana'], ':tel'=>$_POST['tel'], ':address'=>$_POST['address']);
 $stmt->execute($params);
}

// 参照 select(条件付き)
public function findById($id) {
  $sql = 'SELECT * FROM user WHERE id = :id';
  $stmt = $this->con->prepare($sql);
  $params = array(':id'=>$id);
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}


 public function member() {
   $sql = "SELECT id, name, katakana FROM user WHERE id = :id";
   $stmt = $this->con->prepare($sql);
   $params = array(':id'=>$_POST['id'], ':name'=>$_POST['name'], ':katakana'=>$_POST['katakana']);
   $stmt->execute($params);
   $result = $stmt->fetch();
   return $result;
 }

 // いいねした人とされた人のuser_id取得
 public function favoriteAdd() {
     $sql = "INSERT INTO favorite(user_id, liked_id) VALUES(:user_id, :liked_id)";
     $stmt = $this->con->prepare($sql);
     $params = array(':user_id'=>$_SESSION['User']['id'], ':liked_id'=>$_GET['favorite']);
     $stmt->execute($params);
 }

// いいねした人の投稿をすべて表示
 public function favoriteAll() {
   $sql = 'SELECT * FROM fish f JOIN favorite fa ON fa.user_id = :user_id AND fa.liked_id = f.user_id ORDER BY catch_time DESC';
   $stmt = $this->con->prepare($sql);
   $params = array(':user_id'=>$_SESSION['User']['id']);
   $stmt->execute($params);
   $result = $stmt->fetchAll();
   return $result;
 }

 // パスワードリセット　update
 public function passreset($arr) {
  $sql = "UPDATE user SET name = :name, password = :password WHERE name = :name";
  $stmt = $this->con->prepare($sql);
  $params = array(':name'=>$arr['name'], ':password'=>password_hash($arr['password'], PASSWORD_DEFAULT));
  $stmt->execute($params);
 }


  // 入力チェック
  public function validate($arr) {
    $message = array();
    // ユーザー名
if(empty($arr['name'])) {
  $message['name'] = '※お名前を入力してください。';
}

else {
      if (mb_strlen($arr["name"]) > 10) {
        $message['name'] = "※氏名は10文字以内で入力してください";
      }
    }
    // カタカナ
    if(empty($arr['katakana'])) {
      $message['katakana'] = '※カタカナ欄を入力してください。';
    }

    else {
          if (mb_strlen($arr["katakana"]) > 10) {
            $message['katakana'] = "※カタカナ欄は10文字以内で入力してください";
          }
        }
// パスワード
  if(empty($arr['password'])) {
    $message['password'] = '※パスワードを入力してください。';
  }

// 電話番号
if(empty($arr['tel'])) {
$message['tel'] = '※電話番号を入力してください。';
}

else {
  if(!preg_match('/^[0-9]+$/', $arr["tel"])) {
    $message['tel'] = '※数字を入力してください。';
  }
}
// メールアドレス
if(empty($arr['address'])) {
$message['address'] = '※住所を入力してください。';
}
  return $message;
}



}
