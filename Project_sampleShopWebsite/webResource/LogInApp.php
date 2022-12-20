<?php
include_once 'member.inc';
if(isset($_POST['btnSubmit']))
{
    $connectDB=connectDB();
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
                $loginflag=1;
                break;
            }
        }
        if(!$loginflag)
        {echo "<td class='state_message'>訊息</td><td>帳號or密碼錯誤，請確認後再次登入</td>";}
    }
    $connectDB->close();
}               