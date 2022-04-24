<link rel="stylesheet" href="css/style.css">

<?php
$getData = new getData();
$userData = $getData->getUserData();
$postData = $getData->getPostData();

echo $userData, $postData;
?>

