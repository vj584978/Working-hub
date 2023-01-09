<?php
    function connectDB()
    {
        $connectDB=new mysqli("localhost","root","h4s0911907581");
        $connectDB->select_db("system");
        $connectDB->set_charset("utf8");
        return $connectDB;
    }
    function dbClose()
    {
        connectDB()->close();
    }
    function dbState()
    {
        $connectInfo=connectDB()->connect_error;
        if($connectInfo)
        {die("連線失敗!<br>錯誤訊息：$connectInfo");}
        else
        {echo "連線成功!<br>";}
    }
    function dbQuery($sql)
    {
        $queryResult=connectDB()->query("$sql");
        return $queryResult;
    }
    function adLogin()
    {
        $userLogIn="SELECT account,password FROM AdminAccount;";
        $queryResult=connectDB()->query($userLogIn);
        return $queryResult;
    }
    function adisLogin_cookie()
    {
        if(!isset($_COOKIE['adlogin']))
        {
            header("location:BaAdm_Login.php");
        }
    }
    function adisLogin_state()
    {
        if(!isset($_COOKIE['adlogin']))
        {echo "未登入";}
        else 
        {echo "已登入，使用者為：".$_COOKIE['adlogin'][0];}
    }
