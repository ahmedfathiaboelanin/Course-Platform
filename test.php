<?php
    function sum($x,$y){
        $z=0;
        for($n = $x;$n<=$y;$n++){
            echo $n . "<br>";
            $z+=$n;
        }
        return $z;
    }
    echo sum(5,10);
?>