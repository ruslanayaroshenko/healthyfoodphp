<?php 
ULogin(0);
Head('Вхід') ;
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu(); 
 MessageShow() ;
?>
    
<div class="Page">
<form method="POST" action="account/login">
<input type="text" name="login" placeholder="Логін" maxlength="15" >
<br><input type="password" name="password" placeholder="Пароль" maxlength="100"  >
    <div class="capdiv">
<input type ="text" class="capdinp" name="captcha" placeholder="Введіть код нижче" pattern="[0-9]{1,5}" > 
         <br><img src = "/resource/captcha.php" class="capdimg" alt= "Капча"> </div>
<br><br><input type="submit" name="enter_lo" value="Вхід"> <input type="reset" value="Очистити">
</form>
</div>
</div>

<?php Footer();ini_set('display_errors', 1);
 error_reporting(E_ERROR | E_WARNING | E_PARSE);
    
    ini_set('error_reporting', E_ALL); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);?>
</div>
</body>
</html>