<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'member.inc';
isLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登出系統</title>
        <style>
            
        </style>
        <script>
            
        </script>
    </head>
    <body>
        <center>
            <?php
            for($i=0;$i<count($_COOKIE['login']);$i++)
            {
                setcookie("login[$i]","",time()-86400);
            }
            echo "掰掰~<br/>";
            echo "<a href='LogIn.php'>重新登入</a><br/>";        
            echo "3秒後自動轉跳至首頁";
            echo "<script language='javascript'>setTimeout(()=>{location.href='index.php'},1000)</script>";
            ?> 
        </center>
    <?php dbclose() ?>
    </body>
</html>
