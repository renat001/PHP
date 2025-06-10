<?php
function callCounter(){
    static $count = 0;
    $count++;
    echo "The value is: $count <br>";
}
callCounter();
callCounter();
callCounter();
callCounter();
callCounter();


?>