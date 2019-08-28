<?php
/**Функция для подсчета количества вариантов размещения 
 * заданого количества фигур на доске с заданной размерностью.
 * 
 * @param integer $x - размерность доски по координате Х
 * @param integer $y - размерность доски по координате Y
 * @param integer $count_figure - количество размещаемых пешок(фигур)
 * @return array|integer
 */
function CountCombination($x, $y, $count_figure) {
    $size_board = $x * $y;
    $combination = 1;
    if ($size_board < $count_figure) {
        return ['error' => 'Размерность доски недостаточна для размещения заданого количества фигур'];
    } else {
        for ($i = 1; $i <= $count_figure; $i++) {
            $combination *= $size_board;
            $size_board--;
        }
    return $combination;
    }
}


