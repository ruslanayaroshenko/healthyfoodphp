<?php

ini_set('display_errors', 1);
 error_reporting(E_ERROR | E_WARNING | E_PARSE);
Head("Профіль користувача");
ULogin(1); 
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">      
<?php Menu();
    MessageShow() ;?>
<div class="Page">
<?php
    echo'
  юзер  '.$_SESSION['USER_ID'].'
 имя '.$_SESSION['USER_NAME'].'
дата '.$_SESSION['USER_REGDATE'].'
маил'.$_SESSION['USER_EMAIL'].' ';?>
    
    
    
  </div></div><?php Footer();?>
</div>
</body>
</html>






