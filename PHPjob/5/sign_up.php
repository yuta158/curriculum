<?php

// クリックジャッキング対策
header("X-FRAME-OPTIONS: DENY");

require_once 'db/dbc.php';

// メッセージの初期化
$msg = '';

$name = $_POST['name'];
$pass = $_POST['pass'];

// passwordをハッシュ化
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);

//DB接続
$pdo = connect();
// emailがusersテーブルに登録済みか確認
$sql = 'SELECT * FROM users WHERE name = :name';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->execute();
// $user = $stmt->fetch(PDO::FETCH_OBJ);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 新規登録ボタンが押下されたら
if ($_POST['new_register']) {
  if (empty($_POST['name']) || empty($_POST['pass'])) {
    echo 'ユーザ名かパスワードが入力されていません。';
  }
  if (!empty($_POST['name']) && !empty($_POST['pass'])) {
    /* ユーザーがいる場合 */
    if ($user) {
      echo '※すでにご登録のユーザー名は使用されています';
      exit;
    }
  }
}

// POSTで送られていれば処理実行
if ($_POST) {
  // nameとpassword両方送られてきたら処理実行
  if (!empty($name) && !empty($pass)) {
    try {
      // SQL文の準備
      $sql = "INSERT INTO users (name, password) VALUES('$name',:pass)";
      // プリペアドステートメントの作成
      $stmt = $pdo->prepare($sql);
      // 値をセット
      $stmt->bindValue(':pass', $hash_pass);
      // 実行
      $stmt->execute();
      $msg .= 'アカウント登録が完了しました。';
    } catch (PDOException $e) {
      echo 'Error  :  ' . $e->getMessage();
      exit;
    }
  }
}

?>

<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ユーザー登録画面</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<h2>ユーザー登録画面</h2>
<p><?php echo $msg; ?> </p>
<form method="POST">
  <input type="text" name="name" placeholder="ユーザー名" class="form">
  <input type="text" name="pass" placeholder="パスワード" class="form">
  <input class="sign_up_btn" type="submit" name="new_register" value="新規登録">
  <p>既にアカウントをお持ちですか？<a href="login.php">ログイン</a></p>
</form>
</body>

</html>