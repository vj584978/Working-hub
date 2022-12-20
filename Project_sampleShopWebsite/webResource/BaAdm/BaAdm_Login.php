<!DOCTYPE html>
<!--連結inc設定黨-->
<?php include_once 'BaAdm.inc'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>後台系統</title>
        <link rel="stylesheet" href="btnCss.css" > <!--按鈕CSS-->
        <style>
            *{
                box-sizing: border-box;
            }
            table{
                width: 350px;
            }
            .table_title{
                width:120px;
            }
            select,input{
                width: 100%;
            }
            .state_message{
                width:60px;
            }
        </style>
        <script>
            
        </script>
    </head>
    <body>
        <center>
            <h1>登入後台系統</h1>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                <table border="2">
                    <tr>
                        <td class="table_title">帳號：</td>
                        <td>
                            <input type="text" name="account" placeholder="請輸入帳號"/>
                        </td>
                    </tr>
                    <tr>
                        <td>密碼：</td>
                        <td>
                            <input type="password" name="password" id="password" placeholder="請輸入密碼"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="btnOut">
                                <div class="btn"><input type="submit" name="btnSubmit" value="登入"/></div>
                                <div class="btn"><input type="reset" name="btnReset" value="重填"/></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <table border="2">
                <tr>
                <?php
                if(isset($_POST['btnSubmit']))
                {
                    //設定輸出輸入變數
                    $account=$_POST['account'];
                    $password=$_POST['password'];
                    //SQL操作DB
                    $loginflag=0;
                    if($result=adLogin())
                    {
                        while($row=$result->fetch_assoc())
                        {
                            if($account===$row['account'] && $password===$row['password'])
                            {
                                //以陣列存儲使用者訊息
                                $userInfo=array($row['account'],$row['password']);
                                //設置cookie
                                for($i=0;$i<count($userInfo);$i++)
                                {
                                    setcookie("adlogin[$i]",$userInfo[$i],time()+86400*1);
                                }
                                echo "<td class='state_message'>訊息</td><td>";
                                echo "登入成功<br>帳號：{$row['account']}<br>";
                                echo "3秒後跳轉至後台頁面";
                                echo "<a href='BaAdm_index.php'>立即轉跳</a>";
                                echo "</td></tr>";
                                $loginflag=1;
                                echo "<script language='javascript'>setTimeout(()=>{location.href='BaAdm_index.php'},3000)</script>";
                                
                                break;
                            }
                        }
                        if(!$loginflag)
                        {echo "<td class='state_message'>訊息</td><td>帳號or密碼錯誤，請確認後再次登入</td>";}
                    }
                }
                ?>
                    <?php dbclose() ?>
            </table>
        </center>
    </body>
</html>
