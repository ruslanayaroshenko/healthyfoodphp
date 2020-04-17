<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL); 
ULogin(0);
//реєстрація користувача
if ($Module == 'register' and $_POST['enter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['email'] = FormChars($_POST['email']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['captcha'] = FormChars($_POST['captcha']);


if ($_POST['login']=='' or $_POST['email']=='' or $_POST['password']=='' or $_POST['name']=='' or  $_POST['captcha']=='') MessageSend(1, 'Заповніть усі поля');
//if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Неправльно введена капча!');
    
$Row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `login` FROM users WHERE login = '$_POST[login]'"));
if ($Row['login']   ) 
   MessageSend(1, 'Логін <b>'.$_POST['login'].'</b> вже використовується.');
    
$Row['email'] = mysqli_fetch_assoc(mysqli_query($connect, "select `email` from users where email = '$_POST[email]'"));
if ($Row['email'] )  MessageSend(1,'E-Mail <b>'.$_POST['email'].'</b> вже використовується.');
    
mysqli_query($connect, "insert into `users` values (NULL, '$_POST[login]', '$_POST[password]', '$_POST[name]', NOW(), '$_POST[email]', 0)");
   
    //пошта
$Code = str_replace('=', '', base64_encode($_POST['email']));
mail($_POST['email'], 'Реєстрація на сайті "Healthyfood34!"', 'Посилання для активації: http://healthyfood34.000webhostapp.com/account/activate/code/'.substr($Code, -5).substr($Code, 0, -5), 'From: rusya.yaroshenko@gmail.com');
MessageSend(3, 'Реєстрація акаунту успішно завершена. На вказану пошту <b>'.$_POST['email'].'</b> відправлено лист з підтвердженням реєєстрації.');
}

// активація ел адреси в базі
else if ($Module == 'activate' and $Param['code']) {
    if (!$_SESSION['USER_ACTIVE_EMAIL']) {
$Email = base64_decode(substr($Param['code'], 5).substr($Param['code'], 0, 5));
        if (strpos($Email, '@') !== false) {
mysqli_query($connect, "UPDATE `users`  SET `active` = 1 WHERE `email` = '$Email'");
$_SESSION['USER_ACTIVE_EMAIL'] = $Email;
MessageSend(3, 'E-mail <b>'.$Email.'</b> підтверджено.', '/login');
}
else MessageSend(1, 'E-mail адресу не підтверджено.', '/login');
}
else MessageSend(1, 'E-mail адресу <b>'.$_SESSION['USER_ACTIVE_EMAIL'].'</b> уже підтверджено.', '/login');
}


//вхід в профіль
else if ($Module == 'login' and $_POST['enter_lo']) {
 $_POST['login'] = FormChars($_POST['login']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['captcha'] = FormChars($_POST['captcha']);
    if ($_POST['login']== ''  or $_POST['password'] == '' or $_POST['captcha']== '')  
    MessageSend(1, 'Заповніть усі поля');
    
$Row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `password` FROM users WHERE login = '$_POST[login]'")); 
 if ($Row['password'] != $_POST['password']) MessageSend(2,' Паролі не співпадають');
 //if ($Row['active'] == 0)  MessageSend(1, 'Аккаунт користувача <b>'.$_POST['login'].'</b> не підтверджено в базі.'); 
$Row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `id`, `name`, `regdate`, `email`, `password`, `login` FROM users WHERE 'login' = '$_POST[login]'"));
$_SESSION['USER_ID'] = $Row['id']; 
$_SESSION['USER_NAME'] = $Row['name'];
$_SESSION['USER_REGDATE'] = $Row['regdate'];
$_SESSION['USER_EMAIL'] = $Row['email'];
$_SESSION['USER_LOGIN_IN'] = 1; //присвоюємо ULogin = 1 як для зареєстрованого користувача 
exit(header('Location: /profile')); //при успіху заходимо в профіль
}
?>