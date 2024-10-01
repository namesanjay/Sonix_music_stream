<?php
$x=10;
$y=5;
function test(){
    global $x,$y;
    echo "$x<br>$y";
    $x+=$y;
}
test();
echo "<br>$x"
?>