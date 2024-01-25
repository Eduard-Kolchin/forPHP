<?php

$username = $_POST['login'] ?? null;
$password = sha1($_POST['password']) ?? null;
// книга паролей (нехэшированные пароли в конце строк)
$users = [                                                                                                                                 //psw
     'admin' => ['id' => '1', 'password' => '0a620481ca00b00de7eedb407a68b9163dcabae3', 'gender' => 'true', 'birthday' => '04.02.1985'], //000001
     'vasja' => ['id' => '2', 'password' => '0d0c3ed033bf4cccc80c3b986f8e7f473ab32fe0', 'gender' => 'true', 'birthday' =>'05.04.1988'], //000010
     'kolja' => ['id' => '3', 'password' => 'bee38ad6c4429734da19c542e73a787190d2c71b', 'gender' => 'true', 'birthday' => '06.06.1991'], //000011
     'jamshut' => ['id' => '4', 'password' => 'e3a69f4184640e576ca0e07841f76c234a72a412', 'gender' => 'true', 'birthday' => '07.08.1997'], //000100
     'sveta' => ['id' => '5', 'password' => 'd780dc14b58b090f5feefd6501af15354e78dc2e', 'gender' => 'false', 'birthday' => '08.10.2002'], //000101
     'olga' => ['id' => '6', 'password' => '2337060caa88262af884ebe6996bbdc681393ebf', 'gender' => 'false', 'birthday' => '09.11.2005'], //000110
     'gulchataj' => ['id' => '7', 'password' => '7aa214769a592fca2796549f25d07d5a4b10a0c6', 'gender' => 'false', 'birthday' => '10.12.2007'], //000111
];


if (null !== $username || null !== $password) {

    // Если пароль из базы совпадает с паролем из формы
    if ($password === $users[$username]['password']) {
         // Стартуем сессию:
        session_start(); 
        
   	 // Пишем в сессию информацию о том, что мы авторизовались:
        $_SESSION['auth'] = true; 
        
        // Пишем в сессию логин и id пользователя
        $_SESSION['id'] = $users[$username]['id']; 
        $_SESSION['login'] = $username; 
        $_SESSION['gender'] = $users[$username]['gender'];
        $_SESSION['birthday'] = $users[$username]['birthday'];
        $_SESSION['discount'] = time() + 86400;
    }
}

    
$auth = $_SESSION['auth'] ?? null;

// если авторизованы
if ($auth) {
//переходим на главную
$new_url = '../index.php';
header('Location: '.$new_url);
}