<?php
    session_start();

    //удаление данных сессии
    unset($_SESSION['auth']);
    unset($_SESSION['id']);
    unset($_SESSION['login']);

    //возврат на главную
    $new_url = '../index.php';
    header('Location: '.$new_url);