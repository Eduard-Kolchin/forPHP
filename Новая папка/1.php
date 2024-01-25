<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

// Преобразует три строки (фамилию, имя и отчество) в одну (ФИО склеенные через пробел)
function getFullnameFromParts($surname, $name, $patronomyc) {
    return $surname . ' ' . $name . ' ' . $patronomyc;
};

// Преобразует одну строку (склеенное ФИО) в массив из трёх элементов с ключами 'surname' и 'name' и 'patronomyc'
function getPartsFromFullname($fullname){
    [$surname , $name , $patronomyc] = explode(' ',$fullname);
    return ['surname'=>$surname , 'name'=>$name , 'patronomyc'=>$patronomyc];
};

// Преобразование к виду Имя Ф.(аргумент - строка, содержащая ФИО вида «Иванов Иван Иванович»)
function getShortName($fullname){
    $parts = getPartsFromFullname($fullname);
    $initial = mb_substr($parts['surname'] ,0,1);
    return ucfirst($parts['name']) . ' ' . mb_strtoupper($initial) . '.';
};

// Определение пола (аргумент - строка, содержащая ФИО вида «Иванов Иван Иванович»)
function getGenderFromName($fullname){
    $parts = getPartsFromFullname($fullname);
    $gender = 0;
    // проверка окончаний фамилии
    if (mb_substr($parts['surname'] ,-1,1) == 'в'){
        $gender++;
    };
    if (mb_substr($parts['surname'] ,-1,1) == 'а'){
        $gender--;
    };
    //проверка оканчивается ли имя на гласную
    $tip = mb_substr($parts['name'] ,-1,1);
    if ($tip == 'а'||$tip == 'е'||$tip == 'ё'||$tip == 'и'||$tip == 'о'||$tip == 'у'||$tip == 'ы'||$tip == 'э'||$tip == 'ю'||$tip == 'я'){
        $gender--;
    } else {
        $gender++;
    };
    //проверка окончаний отчества
    if (mb_substr($parts['patronomyc'] ,-2,2) == 'ич'){
        $gender++;
    };
    if (mb_substr($parts['patronomyc'] ,-2,2) == 'на'){
        $gender--;
    };
    //итоговый гендер
    return $gender <=> 0;
};


// Определение полового состава аудитории
function getGenderDescription($array){
    $fullnameArray = array_column($array, 'fullname'); // создание массива ФИО из исходного Json
    $quantityPeople = count($fullnameArray);
    $man = 0;
    $woman = 0;
    foreach ($fullnameArray as $value) {
        if (getGenderFromName($value)<0){
            $woman++;
        };
        if (getGenderFromName($value)>0){
            $man++;
        };
    };
    $somebody = $quantityPeople - $man - $woman;
    $man = round($man*100/$quantityPeople , 1);
    $woman = round($woman*100/$quantityPeople , 1);
    $somebody = round($somebody*100/$quantityPeople , 1);
    echo <<<messeg
    Гендерный состав аудитории:
    ---------------------------
    Мужчины - $man %
    Женщины - $woman %
    Не удалось определить - $somebody % \n
messeg;
};

// Определение «идеальной» пары
function getPerfectPartner($surname, $name, $patronomyc, $array){
    // Приводим к нужному регистру ФИО и соеденяем в строку

    $surname = ucfirst($surname);
    $name = ucfirst($name);
    $patronomyc = ucfirst($patronomyc);
    $fullname = getFullnameFromParts($surname, $name, $patronomyc);
    // Определяем пол
    $gender = getGenderFromName($fullname);
    // Поиск партнёра противоположного пола
    $fullnameArray = array_column($array, 'fullname'); // создание массива ФИО из исходного Json
    do {
        $number = random_int(0,count($fullnameArray)-1);
        $perfectPartner = $fullnameArray[$number];
        $genderPartner = getGenderFromName($perfectPartner);
    } while ($genderPartner == $gender);
    // Вывод пары и процента совместимости
    $first = getShortName($fullname);
    $second = getShortName($perfectPartner);
    $randomPercent = random_int(5000 , 10000) / 100;
    echo <<<messeg
    $first + $second = 
    ♡ Идеально на $randomPercent % ♡ \n
messeg;
};
//getGenderDescription($example_persons_array); // вывод состава аудитории
//getPerfectPartner('Волочкова' , 'Анастасия' , 'Юрьевна' , $example_persons_array); // пара для Волочковой
?>