<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'member.inc';
isLogin_cookie();
$connectDB=connectDB();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="btnCss.css" > <!--按鈕CSS-->
        <style>
            *{
                box-sizing: border-box;
            }
            table{
                width: 500px;
                height: 500px;
            }
            input{
                width: 100%;
            }
            td{
                height: 25px;
            }
            textarea{
                width: 100%;
                height: 350px;
            }
            .state_message{
                width:120px;
            }
        </style>
    </head>
    <body>
        <div style="display:flex;justify-content: center ">
        <div style="display:flex">
        <div>
            <form method="GET" action="<?php $_SERVER['PHP_SELF']?>">
            <table border="2">
                <tr>
                    <td class="state_message">電子郵件：</td>
                    <td>
                        <input type="email" name="email_cookie" id="email" value="<?=$_COOKIE['login'][0]?>" disabled/>
                        <input type="hidden" name="email" value="<?=$_COOKIE['login'][0]?>"/>
                    </td>
                </tr>
                <tr>
                    <td>暱　　稱：</td>
                    <td>
                        <input type="text" name="nickname" id="nickname" placeholder="請輸入暱稱"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">留　　言：</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="message" id="message" placeholder="說點甚麼..."/></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btnOut">
                            <div class="btn"><input type="submit" name="btnSubmit" value="送出"/></div>
                            <div class="btn"><input type="reset" name="btnReset" value="重填"/></div>
                        </div>
                    </td>        
                </tr>
                <tr>
                    <td>系統連線狀態：</td>
                    <!--呼叫inc檔函數設定DB連結-->
                    <td><?php dbState(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><a href='LogOut.php'>登出系統</a></td>
                </tr>
                <tr>
                    <td>狀態：</td>
                    <td>
                    <?php
                    if(isset($_GET['btnSubmit']))
                    {
                        //輸出輸入變數設定
                        $email=$_GET['email'];
                        $nickname=$_GET['nickname'];
                        $message=$_GET['message'];
                        //日期戳記
                        date_default_timezone_set('Asia/Taipei');
                        $timeStamp=date('Y/m/d h:i A');
                        //SQL操作
                        $messageWriteIn="INSERT INTO `system`.`message` (`useremail`, `usernickname`, `message`, `timestamp`)
                                         VALUES ('$email', '$nickname', '$message', '$timeStamp');";
                        if($result=$connectDB->query($messageWriteIn))
                        {echo "留言成功";}
                        else
                        {echo "留言失敗";}
                    }
                    ?>
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <div style="width:450px;height:557px;border:2px black solid;overflow-y: scroll;padding: 10px">
            <?php
                //SQL操作
                $messageReadOut="select id,useremail,usernickname,timestamp,message from message order by id desc";
                if($result=$connectDB->query($messageReadOut))
                {
                    while($row=$result->fetch_assoc())
                    {
                        echo "來　　自： {$row['useremail']}<br/>";
                        echo "暱　　稱： {$row['usernickname']}<br/>";
                        echo "留言時間： {$row['timestamp']}<br/>";
                        echo "說：<br/> {$row['message']}<hr/>";
                    }
                }
            ?>
        </div>
        </div>
        </div>
        <?php dbclose() ?>
    </body>
</html>
