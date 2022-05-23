<?php

// クリックジャッキング対策
header("X-FRAME-OPTIONS: DENY");

require_once 'db/dbc.php';
require_once './function.php';

// メッセージの初期化
$msg = '';

if (!empty($_POST['login'])) {
  $name = $_POST['name'];
  $pass = $_POST['pass'];
  // エスケープ処理
  if (!empty($name) && !empty($pass)) {
    h($name);
    h($pass);
  }
}

// セッション開始
session_start();

// POSTで送られていれば処理実行
if (!empty($_POST['login'])) {
  // ログイン名が入力されていない場合の処理
  if (empty($name)) {
    $msg .= '※ユーザー名を入力してください' . '<br>';
  }
  // パスワードが入力されていない場合の処理
  if (empty($pass)) {
    $msg .= '※パスワードを入力してください' . '<br>';
  }

  // nameとpassword両方入力されていたら処理実行
  if (!empty($name) && !empty($pass)) {
    //DB接続
    $pdo = connect();
    try {
      //データベースアクセスの処理文章。ログイン名があるか判定
      // SQL文の準備
      $sql = "SELECT * FROM users WHERE name = :name";
      // プリペアドステートメントの作成
      $stmt = $pdo->prepare($sql);
      // 値をセット
      $stmt->bindValue(':name', $name);
      // 実行
      $stmt->execute();
    } catch (PDOException $e) {
      echo 'Error   :   ' . $e->getMessage();
      exit;
    }
    // ユーザー名がDBから1件取得できたら
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // 入力されたパスワードとDBから取得したハッシュ値が同じか判定
      if (password_verify($pass, $row['password'])) {
        // DBのユーザー情報をセッションに保存
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        // main.phpにリダイレクト
        header("Location: main.php");
        exit;
      } else {
        $msg = 'パスワードに誤りがあります。' . '<br>';
      }
    } else {
      //ログイン名がなかった時の処理
      $msg = 'パスワードに誤りがあるか、' . "<br>" . 'アカウントの登録がありません。';
    }
  }
}

?>

<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ログイン画面</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <form action="sign_up.php" method="POST">
    <div class="flex">
      <h2>ログイン画面</h2>
      <div class="vertical">
        <input class="sign_up_btn" type="submit" name="to_sign_up" value="新規ユーザー登録">
      </div>
    </div>
    <p style="color: red;"><?php echo $msg; ?></p>
  </form>
  <form method="POST">
    <input class="form" type="text" name="name" placeholder="ユーザー名">
    <input class="form" type="text" name="pass" placeholder="パスワード">
    <input class="login_btn" type="submit" name="login" value="ログイン">
  </form>
</body>

</html>