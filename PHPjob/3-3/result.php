<?php
// $result = ['凶', '小吉', '中吉', '吉', '大吉'];
$num = $_POST['number'];
// substr(対象の文字列, 開始位置, 文字数)
$subno = substr($num, mt_rand(0, strlen($num) - 1), 1);
?>

<p><?php echo date('Y/m/d', time()) . PHP_EOL; ?>の運勢は</p>
<p>選ばれた数字は : <?php echo $subno; ?></p>
<?php
$result = ['凶', '小吉', '中吉', '吉', '大吉'];
switch ($subno) {
    case 0:
        echo $result[0];
        break;
    case 1:
    case 2:
    case 3:
        echo $result[1];
        break;
    case 4:
    case 5:
    case 6:
        echo $result[2];
        break;
    case 7:
    case 8:
        echo $result[3];
        break;
    case 9:
        echo $result[4];
        break;
}
?>

