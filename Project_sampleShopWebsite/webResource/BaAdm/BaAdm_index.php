<!DOCTYPE html>
<?php
include_once 'BaAdm.inc';
adisLogin_cookie();
?>
<html>
    <head>
        <title>後台系統</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            *{
                box-sizing: border-box;
            }
            #box{
                border: 2px black double;
                width:1440px;
                height: 850px;
                display: flex;
            }
            #navBar{
                border-right: 2px black double;
                background-color: lightcyan;
                width: 288px;
                height: 100%;
            }
            #navBar table{
                width: 100%;
                margin: 20px;
            }
            #main{
                background-color: lightgoldenrodyellow;
                width: 1152px;
                height: 100%;
                display: flex;
            }
            iframe{
                width: 100%;
                height: 100%;
                border: 2px black solid;
            }
            #footer{
                border: 2px black dashed;
                width:1440px;
                height: 35px;
                background-color:greenyellow;
                text-align: left;
                display: flex;
                align-items: center;
            }
            #footer td{
                padding: 2px;
            }
        </style>
        <script>
            function time()
            {
                setInterval(function t(){
                    var time=Date();
                    document.getElementById('time').innerHTML=time;
                },1000); 
            }
        </script>
    </head>
    <body onload="time()">
        <center>
            <div id="box">
                <div id="navBar">
                    <table>
                        <tr><td>帳號相關</td></tr>
                        <tr><td>　┣<a href="" target="maindisplay"></a>預留</td></tr>
                        <tr><td>　┗<a href="BaAdm_Logout.php">登出系統</a></td></tr>
                        <tr><td>商品相關</td></tr>
                        <tr><td>　┣<a href="BaAdm_ProductShow.php" target="maindisplay">商品總覽</a></td></tr>
                        <tr><td>　┣<a href="BaAdm_ProductSE.php" target="maindisplay">商品查改</a></td></tr>
                        <tr><td>　┣<a href="BaAdm_StorageE.php" target="maindisplay">庫存查改</a></td></tr>
                        <tr><td>　┣<a href="BaAdm_CSedit.php" target="maindisplay">類別/供應商查改</a></td></tr>
                        <tr><td>　┣<a href="BaAdm_OrderSE.php" target="maindisplay">訂單查改</a></td></tr>
                        <tr><td>　┗<a href="" target="maindisplay"></a>預留</td></tr>
                    </table>
                </div>
                <div id="main">
                    <iframe name="maindisplay" src="<?php if(isset($_COOKIE['adlogin'])){echo 'wellcome.php';}else{echo "BaAdm_Login.php";} ?>"></iframe>
                </div>
            </div>
            <div id="footer">
                <table>
                    <tr>
                        <td>系統連線狀態：<?php dbState() ?></td>
                        <td style="background-color: black;"></td>
                        <td>
                            <?php adisLogin_state(); ?>
                        </td>
                        <td style="background-color: black;"></td>
                        <td>現在時間：<span id="time"></span></td>
                        <?php dbclose() ?>
                    </tr>
                </table>
            </div>
        </center>
    </body>
</html>
