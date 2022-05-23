
<?php

// セッションにuser_nameの値がなければlogin.phpにリダイレクト
function check_user_logged_in()
{
  session_start();
  if (empty($_SESSION['user_name'])) {

    header('Location: login.php');
  }
}

/* ログイン名とパスワードのエスケープ処理
 htmlspecialchars( 変換対象文字, 変換パターン, 文字コード )
 HTMLタグを文字列として表示 */
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>