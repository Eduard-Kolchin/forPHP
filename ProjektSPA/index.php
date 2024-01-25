
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Восток Спа</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>

        <div id="label">
            <p>
                <span id="vostok">Восток SPA </br></span>
                +7 999 999 99 99
            </p>
        </div>

        <nav>
            <p>
                <a href="#"> О НАС </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#"> УСЛУГИ </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#"> СЕРТИФИКАТЫ </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#"> SPA-ЭТИКЕТ </a>
            </p>
        </nav>

        <div id="login">
            <p>
                <?php
                session_start(); 
                $auth = $_SESSION['auth'] ?? null;

                if ($auth) {
                    $login = ucfirst($_SESSION['login']);
                    $birthday = $_SESSION['birthday'];
                    //рассчет колличества дней до дня рождения
                    $arr = explode('.', $birthday);
                    $tm=mktime(0, 0, 0, $arr[1], $arr[0], date('Y'));
                    if($tm<time()) $tm=mktime(0, 0, 0, $arr[1], $arr[0], date('Y')+1);
                    $dayToBD = intval( ($tm-time())/86400 );

                    echo $login . '&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp' . '<a href="pages/delogin.php"> выйти</a></br>';
                    if ($dayToBD) echo '<small>Дней до вашего</br> дня рождения:' . ' ' . $dayToBD . '</small>';
                    else echo 'С Днем Рождения!!!';
                }
                else {
                    echo '<a href="pages/login.php"> Войти</a>';
                }
                ?>
            </p>
        </div>
    </header>

    <main>

        <section id="topSection">
            <a href="#" class="topSection">
                <p>Выбрать программу</p>
            </a>
            <a href="#" class="topSection">
                <p>Приобрести абонемент</p>
            </a>
        </section>

        <?php
        if ($auth) {
                // персональная акция с таймером
            $endDiscount = $_SESSION['discount']; // дата окончания персональной скидки
            $seconds = $endDiscount - time(); // оставшееся время (в секундах)

            $hours = floor($seconds / 3600); // часы до даты
            $seconds -= ($hours * 3600);     // вычитаем часы

            $minutes = floor($seconds / 60); //минуты до даты
            $seconds -= ($minutes * 60);     //вычитаем минуты
            ?>
            <div id="timer">
                <a href="#">Только для вас: персональная скидка 15% </br> на королевский массаж в 4 руки</br>
            <?php
            echo "До окончания акции осталось $hours ч., $minutes мин., $seconds с.</a></div>";
        }
            ?>
            
        <section id="action">
            <?php
            $gender = $_SESSION['gender'];
                //выводим не больше 4х акций
            $count = 0; //номер акции по порядку вывода

            if ($auth) {
                if (!$dayToBD) { //если дней до дня рождения 0 (сегодня ДР)
                    ++$count;
                    ?>
                    <div class="action birthday">
                        <p>Для вас скидка 5% Только в ваш день рождения</p>
                    </div>
                    <?php
                }
            }

            ++$count;
            ?>
            <div class="action discount">
                <p>Счастливые часы.</br>По будням с 11:00 до 16:00 скидка 10% на массаж</p>
            </div>
            <?php

            if ($auth) {
                if (!$gender) { //акция для женщин
                    if ($count < 4) {
                        ++$count;
                        ?>
                        <div class="action fem">
                            <p>Комплексные процедуры ухода за телом для вашей красоты</p>
                        </div>
                        <?php
                    }
                }

                if (!$gender) { //акция для женщин
                    if ($count < 4) {
                        ++$count;
                        ?>
                        <div class="action fem">
                            <p>Уход за лицом</p>
                        </div>
                        <?php
                    }
                }

                if ($gender) { //акция для мужчин
                    if ($count < 4) {
                        ++$count;
                        ?>
                        <div class="action man">
                            <p>Тайский</br> традиционный массаж</p>
                        </div>
                        <?php
                    }
                }
                
                if ($gender) { //акция для мужчин
                    if ($count < 4) {
                        ++$count;
                        ?>
                        <div class="action man">
                            <p>Массаж глубоких тканей</p>
                        </div>
                        <?php
                    }
                }
            }

            if ($count < 4) {
                ++$count;
                ?>
                <div class="action">
                    <p>Арома массаж</p>
                </div>
                <?php
            }

            if ($count < 4) {
                ++$count;
                ?>
                <div class="action">
                    <p>Тайский массаж горячими травяными мешочками</p>
                </div>
                <?php
            }

            if ($count < 4) {
                ++$count;
                ?>
                <div class="action">
                    <p>Массаж горячими камнями</p>
                </div>
                <?php
            }
            ?>
        </section>

    </main>

    <footer>

        <div class="footerLinks">
            <p>
            <a href="#">Уход за лицом</a>
            <a href="#">Уход за телом</a>
            <a href="#">SPA для двоих</a>
            </p>
        </div>

        <div class="footerLinks">
            <p>
            <a href="#">Мастера</a>
            <a href="#">Контакты</a>
            </p>
        </div>

        <div class="copyright">
            <p>
            &copy; ООО "Восток-СПА"</br>
            +7 999 999 99 99
            </p>
        </div>
    </footer>

</body>
</html>