<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'BaAdm.inc';
adisLogin_cookie()
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>系統登出</title>
        <style>
            
        </style>
        <script>
            
        </script>
    </head>
    <body>
        <center>
            <?php
            for($i=0;$i<count($_COOKIE['adlogin']);$i++)
            {
                setcookie("adlogin[$i]","",time()-86400);
            }
            echo "<h1>~掰掰~</h1><br/>";
            echo "<script language='javascript'>setTimeout(()=>{location.href='../index.php'},1000)</script>";
            ?> 
            <?php dbclose() ?>
        </center>
    </body>
</html>
