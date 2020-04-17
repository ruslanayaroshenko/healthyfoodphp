<?php
include_once "setting.php";
session_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL); 
 error_reporting(E_ERROR | E_WARNING | E_PARSE); 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connect = mysqli_connect (HOST, USER, PASS, DATABASE);



if ($_SERVER['REQUEST_URI'] == '/') {
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);


if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}

if ($Page =='index' and $Module == 'index')	include ('page/index.php');
else if ($Page == "login") include ('page/login.php');
else if ($Page == "register") include ('page/register.php');
else if ($Page == "account") include ('form/account.php');
else if ($Page == "module") include ('page/module.php');
else if ($Page == "profile") include ('page/profile.php');


  
   function ULogin($p1){
if($p1 <= 0 
   and $_SESSION['USER_LOGIN_IN']!=$p1) 
    MessageSend (1, 'Дана сторінка доступна тільки для незареєстрованих користувачів  *гості*');
 else if ($_SESSION['USER_LOGIN_IN'] != $p1) MessageSend (1, 'Дана сторінка доступна тільки для зареєстрованих користувачів сайту.');
} 
  
function MessageSend($p1, $p2, $p3 ='') {
if ($p1 == 1) $p1 = 'Помилка';
else if ($p1 == 2) $p1 = 'Підказка';
else if ($p1 == 3) $p1 = 'Інформація';
$_SESSION['message']= '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
 if ($p3) $_SERVER['HTTP_REFERER']  = $p3;
   exit(header('Location: '.$_SERVER['HTTP_REFERER']));   
}
function MessageShow() {
if ($_SESSION['message'])
    $Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}



       

function FormChars ($p1){
    return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}

function GenPass ($p1, $p2){
    return md5('lolppts' .md5('321'.$p1.'123').md5('678'.$p2.'890') );
}


function Head($p1) {
echo '<!DOCTYPE html><html><head><meta charset="utf-8" /><title>' .$p1. '</title><meta name="keywords" content="" /><meta name="description" content="" /><link href="resource/style.css" rel="stylesheet"></head>';
}

function Menu () {
if ($_SESSION['USER_LOGIN_IN'] != 1) $Menu = '
<a href="/register"><div class="Menu">Реєстрація</div></a>
<a href="/login"><div class="Menu">Вхід</div></a>';
    
else $Menu = '<a href="/profile"><div class="Menu">Профіль</div></a>';
    
echo '<div class="MenuHead"><a href="/"><div class="Menu">Головна</div></a>'.$Menu.'</div>'; 
} 

function Footer  () {
    echo '<footer class="footer">Усі права захищені</footer>';
}
?> 