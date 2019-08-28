<?php
    /**Функция для подсчета времени, полного заполнения стакана
     * амебами, в зависимости от заданных параметров.
     * 
     * @param type $time_divisionv - Время деления одной амебы
     * @param type $count_division - Количество на которое делится амеба 
     * @param type $time_filling - Полное время заполнения стакана
     * @param type $organism - Количество амеб изначально посаженных в стакан
     * @return type
     */


    function FullTimeFilling ($time_division, $count_division, $time_filling, $organism){
        $iteration = $time_filling / $time_division;
        $sum = (1 * ($count_division ** $iteration - 1)) / ($count_division - 1);
        $result = log (($sum * ($count_division - 1) / $organism + 1), $count_division) ;
        $second = $result * $time_division;
        
        return $second;
    }
    
   
	