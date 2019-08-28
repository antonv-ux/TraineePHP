<?php
    require_once 'TestTask2.php';
    require_once 'TestTask3.php';
    
   // FullTimeFilling($time_division, $count_division, $time_filling, $organism);
   // CountCombination($x, $y, $count_figure);
    
    
    echo 'Решение второй задачи' . '</br>';
    $result = CountCombination(3, 3, 8);
    if (($result['error'])){
        echo $result['error'] . '</br>';
    } else {
        echo $result . '</br>';
    }
    
    echo 'Решение третьей задачи' . '</br>';
    echo FullTimeFilling(1, 2, 60, 8);
    

