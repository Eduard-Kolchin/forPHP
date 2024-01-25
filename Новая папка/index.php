<?php

$buy = readline('Введите стоимость покупки:');
$sell = readline('Введите стоимость продажи:');

if ($sell > $buy) {
    echo 'Прибыль ' . ($sell - $buy);
} elseif($sell < $buy) {
    echo 'Убыток ' . ($sell - $buy);
} else {
    echo 'Нет профита или убытка';
}