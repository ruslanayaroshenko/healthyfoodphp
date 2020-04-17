<?php
ULogin(0); Head('Реєстрація') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>

       <div class="Page">
 <form method="POST" action ="account/register">
<br><input type ="text" name="login" placeholder="Логін" maxlength="25" pattern="[A-Za-z-0-9]{6,20}" title = "Укажіть не менше 6 і не більше 20 латинських символів чи цифр"  required > 
<br><input type ="email" name="email" placeholder="Ваша пошта"  required> 
<br><input type ="password" name="password" placeholder="Пароль" maxlength="25" pattern="{6,25}" title= "Укажіть не менше 6 і не більше 25 символів чи цифр" required> 
<br><input type ="text" name="name" placeholder="Ім'я" maxlength="25" pattern="{3,30}" title =  "Укажіть не менше 3 і не більше 30 латинських символів чи цифр" required> 
     <div class="capdiv">
<input type ="text" class="capdinp" name="captcha" placeholder="Введіть код з картинки" pattern="[0-9]{1,5}" required> 
    <img src = "/resource/captcha.php" class="capdimg" alt= "Капча"> </div>
<br><br><br><input type ="submit" name="enter" value="Зареєструватись"><input type ="reset"  value="Очистити">
</form>
 </div>
  </div>
 
<?php Footer(); ini_set('display_errors', 1);
 error_reporting(E_ERROR | E_WARNING | E_PARSE);?>
</div>
</body>
</html>