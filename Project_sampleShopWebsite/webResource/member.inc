<?php

//設定與MySQL DB連線
function connectDB()
{
    //設定DB連線資料 → new mysqli("DB位置","登入帳號","登入密碼")
    $connectDB=@new mysqli("localhost","root","");
    //連線DB.並測試是否正常連線
    if($connectDB->connect_error)
        {die("連線失敗!<br>錯誤訊息：$connectDB->connect_error");}
    //設定連線的DB及編碼
    $connectDB->select_db("system");
    $connectDB->set_charset("utf8");
    return $connectDB;
}
function dbState()
    {
        $connectInfo=connectDB()->connect_error;
        if($connectInfo)
        {die("連線失敗!<br>錯誤訊息：$connectInfo");}
        else
        {echo "連線成功!<br>";}
    }
//cookie驗證+導向
function isLogin_cookie()
{
    if(!isset($_COOKIE['login']))
    {
        header("location:loginAlert.php");
    }
}

function dbQuery($sql)
{
    $queryResult=connectDB()->query("$sql");
    return $queryResult;
}
 function dbclose()
 {
     connectDB()->close();
 }