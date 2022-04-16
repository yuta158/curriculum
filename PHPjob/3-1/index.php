<?php

$i = 1;
while ($i <= 100) {
    if ($i % 3 == 0) {
        echo 'Fizz!';
    } elseif ($i % 5 == 0) {
        echo 'Buzz!';
    } elseif ($i % 3 == 0 && $i % 5 == 0) {
        echo 'FizzBuzz!!';
    } else {
        echo $i;
    }
    echo '<br/>';
    $i++;
}
?>
