<?php
require_once 'db/dbc.php';

$name = $_POST['name'];
$pass = $_POST['pass'];

/* ログイン名とパスワードのエスケープ処理
   htmlspecialchars( 変換対象文字, 変換パターン, 文字コード )
   HTMLタグを文字列として表示 */
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');

// セッション開始
session_start();

// POSTで送られていれば処理実行
if (!empty($_POST)) {
  // ログイン名が入力されていない場合の処理
  if (empty($name)) {
    echo '※名前を入力してください' . '<br>';
  }
  // パスワードが入力されていない場合の処理
  if (empty($pass)) {
    echo '※パスワードを入力してください' . '<br>';
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
      // DB切断
      exit;
    }

    // ユーザー名がDBから1件取得できたら
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // 入力された値とDBから取得したハッシュ値が同じか判定
      if (password_verify($pass, $row['password'])) {

        // セッションに検索したID,PW値を保存
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        // main.phpにリダイレクト
        header("Location: main.php");
        // DB切断
        exit;
      } else {
        // パスワードが違ってた時の処理
        echo 'パスワードに誤りがあります' . '<br>';
      }
    } else {
      //ログイン名がなかった時の処理
      echo 'ユーザー名かパスワードに誤りがあります';
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
  </form>
  <form method="POST">
    <input class="form" type="text" name="name" placeholder="ユーザー名">
    <input class="form" type="text" name="pass" placeholder="パスワード">
    <input class="login_btn" type="submit" name="login" value="ログイン">
  </form>
</body>

</html>