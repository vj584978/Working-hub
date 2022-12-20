<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
    include_once 'member.inc'; 
    $connectDB=connectDB();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>註冊帳號</title>
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
            [id *=password]{
                width: 60%;
            }
        </style>
        <script>
            //較驗密碼確認
            function password_check()
            {
                const password=document.getElementById('password').value;
                const password_conform=document.getElementById('password_conform').value;
                if(password===password_conform)
                {
                    document.getElementById('password_conform_check1').innerHTML="密碼相同";
                    document.getElementById('password_conform_check2').innerHTML="密碼相同";
                    document.getElementById('password_check_flag').value="1";
                }else
                {
                    document.getElementById('password_conform_check1').innerHTML="密碼不相同";
                    document.getElementById('password_conform_check2').innerHTML="密碼不相同";
                    document.getElementById('password_check_flag').value="0";
                }
            }
        </script>
    </head>
    <body>
    <center>
        <h1>註冊帳號</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
            <table border="2">
                <tr>
                    <td class="table_title">帳號：<font size="-2" style="color:red;">(必填)</font></td>
                    <td>
                        <input type="email" name="email" placeholder="請輸入電子郵件"/>
                    </td>
                </tr>
                <tr>
                    <td>密碼：<font size="-2" style="color:red;">(必填)</font></td>
                    <td>
                        <input type="password" name="password" id="password" placeholder="請輸入密碼"/>
                        <!--密碼較驗結果顯示區-->
                        <font id="password_conform_check1" style="color:red;width:20px;"></font>
                    </td>
                </tr>
                <tr>
                    <td>密碼確認：<font size="-2" style="color:red;">(必填)</font></td>
                    <td>
                        <input type="password" name="password_conform" id="password_conform" placeholder="請再次輸入密碼" onchange="password_check()"/>
                        <!--密碼較驗結果顯示區-->
                        <font id="password_conform_check2" name="password_check" style="color:red;"></font>
                        <!--密碼較驗結果儲存區-->
                        <input type="hidden" id="password_check_flag" name="password_check_flag"/>
                    </td>
                </tr>
                <tr>
                    <td>姓名：<font size="-2" style="color:red;">(必填)</font></td>
                    <td>
                        <input type="text" name="username" placeholder="請輸入姓名"/>
                    </td>
                </tr>
                <tr>
                    <td>性別：</td>
                    <td>
                        <select name="gender">
                            <option value="未填寫" selected disable>請選擇性別</option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                            <option value="不男不女">不男不女</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>生日：</td>
                    <td>
                        <input type="date" name="birthday"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btnOut">
                            <div class="btn"><input type="submit" name="btnSubmit" value="註冊"/></div>
                            <div class="btn"><input type="reset" name="btnReset" value="重填"/></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>系統連線狀態：</td>
                    <!--呼叫inc檔函數設定DB連結-->
                    <td><?php dbState(); ?></td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['btnSubmit']))
        {
            //設定輸出輸入變數
            $email=$_POST['email'];
            $password=$_POST['password'];
            $username=$_POST['username'];
            $gender=$_POST['gender'];
            $birthday=$_POST['birthday'];
            $password_check_flag=@$_POST['password_check_flag'];
            //SQL操作DB
            $userSignUp="INSERT INTO `system`.`member` (`email`, `password`, `username`, `gender`, `birthday`)
                         VALUES ('$email', '$password', '$username', '$gender', '$birthday');";
            if($password_check_flag==="1")
                {
                    if($result=$connectDB->query($userSignUp))
                    {
                        echo "註冊成功";
                        echo "請由左側功能列登入";
                    }
                    else
                    {echo "註冊失敗，Email已註冊或資料不完全";}
                }else
                {echo "請確認密碼與密碼確認是否一致";}
                $connectDB->close();
        }
        ?>
    </center>
        
    </body>
</html>
