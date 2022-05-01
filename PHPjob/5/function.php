
<?php

// セッションにuser_nameの値がなければlogin.phpにリダイレクト
function check_user_logged_in()
{
  session_start();
  if (empty($_SESSION['user_name'])) {

    header('Location: login.php');
  }
}
?>