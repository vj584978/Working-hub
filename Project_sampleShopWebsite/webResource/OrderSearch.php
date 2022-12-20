<!DOCTYPE html>
<?php 
include_once 'member.inc';
isLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <form method='GET' action="OrderSearch.php">
            <label>訂單編號：</label><input type='number' name='orderNumber' placeholder='請輸入訂單編號'/>
            <input type='submit' name='btnSearchSubmit' value='查詢'/>
            <input type='submit' name='btnSearchAllSubmit' value='查詢全部訂單'/>
            <table border='2'>
                <thead>
                    <th>訂單編號</th>
                    <th>訂單帳號</th>
                    <th>訂購時間</th>
                    <th>訂購商品</th>
                    <th>訂購數量</th>
                    <th>訂單狀態</th>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_GET['btnSearchAllSubmit']))
                        {
                            $orderSearchAll="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表 where 訂購帳號 = '{$_COOKIE['login'][0]}'";
                            $orderSearchAllReault=dbQuery($orderSearchAll);
                            
                            while($row=$orderSearchAllReault->fetch_row())
                            {
                                echo "<tr>";
                                for($i=0;$i<count($row);$i++)
                                {echo "<td>$row[$i]</td>";}
                                echo "</tr>";
                            }
                        }
                        if(isset($_GET['btnSearchSubmit']))
                        {
                            if($_GET['orderNumber']!=="")
                            {
                                $orderNum=$_GET['orderNumber'];
                                $orderSearch="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表 where 訂單編號 = $orderNum;";
                                $orderSearchReault=dbQuery($orderSearch);
                                while($row=$orderSearchReault->fetch_row())
                                {
                                    echo "<tr>";
                                    for($i=0;$i<count($row);$i++)
                                    {echo "<td>$row[$i]</td>";}
                                    echo "</tr>";
                                }
                            }
                            else
                            {echo "<tr><td colspan='6' align='center'>請輸入訂單編號</td></tr>";}
                        }
                    ?>
                </tbody>
            </table>
        </form>
        <?php dbclose() ?>
    </center>
    </body>
</html>
