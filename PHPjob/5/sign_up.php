<?php
// dbc.phpの読み込みFILL_IN
require_once 'db/dbc.php';

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
$user = $stmt->fetch(PDO::FETCH_OBJ);

// ユーザーがいる場合、本登録済みユーザーなら新規登録処理はせずにメール送信完了画面を表示
// 「登録済みです」と表示するのは、そのメールアドレスを知っている別人がこのメールアドレスを入力した場合に、
// 「このメールアドレスは登録済みである」という情報を与えてしまうので避けたい
if ($user && $user->status !== 'tentative') {
  echo '※すでにご登録のユーザー名は使用されています';

  // リダイレクト後に何かしらの処理をしないため
  exit();
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

      //　登録完了メッセージ出力
      echo '登録完了しました';
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
<form method="POST">
  <?php if ($user && $user->status !== 'tentative') : ?>

    <?php echo '※すでにご登録のユーザー名は使用されています'; ?>
  <?php endif ?>
  <input type="text" name="name" placeholder="ユーザー名" class="form">
  <input type="text" name="pass" placeholder="パスワード" class="form">
  <input class="sign_up_btn" type="submit" name="new_register" value="新規登録">
  <p>既にアカウントをお持ちですか？<a href="login.php">ログイン</a></p>
</form>
</body>

</html>