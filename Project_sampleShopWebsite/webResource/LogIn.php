<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'member.inc'; 

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登入系統</title>
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
            <h1>登入系統</h1>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                <table border="2">
                    <tr>
                        <td class="table_title">帳號：</td>
                        <td>
                            <input type="email" name="email" placeholder="請輸入電子郵件"/>
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
                    <tr>
                        <td colspan="2" align="center">還沒有帳號？點此<a href="SignUp.php">註冊</a></td>
                    </tr>
                    <tr>
                        <td>系統連線狀態：</td>
                        <!--呼叫inc檔函數設定DB連結-->
                        <td><?php $connectDB=connectDB(); ?></td>
                    </tr>
                </table>
            </form>
            <table border="2">
                <tr>
                <?php
                if(isset($_POST['btnSubmit']))
                {
                    //設定輸出輸入變數
                    $email=$_POST['email'];
                    $password=$_POST['password'];
                    //SQL操作DB
                    $userLogIn="SELECT email,password,username FROM member;";
                    $loginflag=0;
                    if($result=$connectDB->query($userLogIn))
                    {
                        while($row=$result->fetch_assoc())
                        {
                            if($email===$row['email'] && $password===$row['password'])
                            {
                                //以陣列存儲使用者訊息
                                $userInfo=array($row['email'],$row['password'],$row['username']);
                                //設置cookie
                                for($i=0;$i<count($userInfo);$i++)
                                {
                                    setcookie("login[$i]",$userInfo[$i],time()+86400*7);
                                }
                                echo "<td class='state_message'>訊息</td><td>";
                                echo "登入成功<br>帳號：{$row['email']}<br>";
                                echo "歡迎回來  ".$row['username']."  先生/小姐<br>";
                                echo "</td></tr>";
                                echo "<tr><td class='state_message'>選單</td>
                                          <td><a href='index.php'>回到首頁</a><br/>
                                              3秒後自動轉跳至首頁
                                              <script language='javascript'>
                                              setTimeout(()=>{location.href='index.php';},3000);
                                              </script>
                                          </td></tr>";
                                $loginflag=1;
                                break;
                            }
                        }
                        if(!$loginflag)
                        {echo "<td class='state_message'>訊息</td><td>帳號or密碼錯誤，請確認後再次登入</td>";}
                    }
                    $connectDB->close();
                }
                ?>
            </table>
        </center>
    </body>
</html>
