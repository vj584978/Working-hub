<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'BaAdm.inc';
adisLogin_cookie()
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>商品總覽</title>
        <style>
            *{
                box-sizing: border-box;
            }
            .searchTable{
                border:1px blue solid;
                width: 90%;
                margin: 20px;
            }
            .editTable{
                border:1px blue solid;
                width: 70%;
                margin: 20px;
            }
            th,td{
                border:1px black solid;
            }

            #box{
                display: flex;
                justify-content: center;
                height: 820px;
            }
            #edit,#show{
                border: 2px black solid;
                width: 50%;
                height: 100%;
                padding: 10px;
            }
            #edit{
                border-right: 2px black solid;
            }
            .serachInput{
                width: 80%;
            }
        </style>
    </head>
    <body>
    <center>
        <div id="box">
            <div id="edit">
                <form method="get" action="<?php $_SERVER['PHP_SELF']?>">
                    <table border="2" class="searchTable">     
                        <tr>
                            <td>訂單搜尋(以編號)</td>
                            <td>
                                <input type="text" name="orderIdSearch" class="serachInput" placeholder="請輸入訂單編號" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td>訂單搜尋(以會員)</td>
                            <td>
                                <input type="text" name="orderBuyerSearch" class="serachInput" placeholder="請輸入會員ID" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                <input type="submit" name="btnOrderSearch" value="　搜尋　"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if(isset($_GET['btnOrderSearch']))
                    {
                        $orderIdSearch = @$_GET['orderIdSearch'];
                        if($orderIdSearch!=="")
                        {
                            $orderIndex="select * from orderindex where id = $orderIdSearch";
                            $orderIndexResult = dbQuery($orderIndex);
                            $orderIndexRows=$orderIndexResult->fetch_assoc();
                            $orderDetail="select * from 訂單總表 where 訂單編號 = $orderIdSearch";
                            $orderDetailResult= dbQuery($orderDetail);
                            $countItem=$orderDetailResult->num_rows;
                        }
                    }
                if(isset($_GET['btnOrderUpdate']))
                {
                    $id=$_GET['id'];
                    $name=$_GET['name'];
                    $amout=$_GET['amout'];
                    $totalItemCount=count($name);
                    for($i=0;$i<$totalItemCount;$i++)
                    {
                        $orderUpdate="update `ordercontent` SET `amout` = '{$amout[$i]}' where id = '{$id}' and product= '{$name[$i]}'";
                        dbQuery($orderUpdate);
                    }
                }
                ?>
                <form>
                    <table border="2" class="editTable">
                        <tr>
                            <td style="width:35%;">訂單編號</td>
                            <td><?php echo @$orderIndexRows['id']; ?><input type="hidden" name='id' value='<?php echo @$orderIndexRows['id']; ?>'></td>
                        </tr>
                        <tr>    
                            <td>訂購帳號</td>
                            <td><?php echo @$orderIndexRows['buyer']; ?></td>
                        </tr>
                        <tr>
                            <td>訂購時間</td>
                            <td><?php echo @$orderIndexRows['timestamp']; ?></td>
                        </tr>
                        <tr>
                            <td>訂單狀態</td>
                            <td><input type="text" name="orderState" value="<?php @$orderIndexRows['state']; ?>" placeholder="請輸入訂單狀態" style="width:100%;"/></td>
                        </tr>
                        <tr>
                            <td>訂單內商品總數</td>
                            <td><?php echo @$countItem ?></td>
                        </tr>
                        <?php
                        if(@$orderDetailResult)
                        {
                            while($orderDetailRow=$orderDetailResult->fetch_assoc())
                            {
                                echo "<tr>";
                                echo "<td>{$orderDetailRow['訂購商品']}<input type='hidden' name='name[]' value='{$orderDetailRow['訂購商品編號']}'/></td>";
                                echo "<td><input type='number' name='amout[]' value='{$orderDetailRow['訂購數量']}' style='width:100%;'/></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="2">僅供修改訂單用，增加請至MySQL新增<input type="submit" name='btnOrderUpdate' value="更新訂單" style="float:right;"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="show">
                <?php
                    //SQL操作
                    if(isset($_GET['btnOrderSearch']))
                    {
                        $orderIdSearch = $_GET['orderIdSearch'];
                        $orderBuyerSearch = $_GET['orderBuyerSearch'];
                        if($orderIdSearch==="" && $orderBuyerSearch==="")
                        {$orderSearch="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表";}
                        elseif($orderIdSearch!=="")
                        {$orderSearch="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表 where 訂單編號 = '{$_GET['orderIdSearch']}'";}
                        elseif ($orderBuyerSearch!=="")
                        {$orderSearch="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表 where 訂購帳號 = '{$_GET['orderBuyerSearch']}'";}
                    }
                    else
                    {
                        $orderSearch="select 訂單編號,訂購帳號,訂購時間,訂購商品,訂購數量,訂單狀態 from 訂單總表";
                    }
                    $result=dbQuery($orderSearch);
                    $totalrow=$result->num_rows;
                    $per=20;
                    $pages= ceil($totalrow/$per);
                    if(!isset($_GET['page']))
                    {$page=1;}
                    else 
                    {$page= intval($_GET['page']);}
                    $start=($page-1)*$per;
                    $split="$orderSearch limit $start,$per;";
                    $splitresult=dbQuery($split);
                ?>
                <table border="2">
                    <thead>
                        <th>訂單編號</th>
                        <th>訂購帳號</th>
                        <th>訂購時間</th>
                        <th>訂購商品</th>
                        <th>訂購數量</th>
                        <th>訂單狀態</th>
                    </thead>
                    <tbody>
                        <?php 
                            while($row=$splitresult->fetch_row())
                                {
                                    echo "<tr>";
                                    for($i=0;$i<count($row);$i++)
                                    {echo "<td>$row[$i]</td>";}
                                    echo "</tr>";
                                }
                        ?>
                    </tbody>
                </table>
                <?php
                //分頁頁碼
                echo '共 '.$totalrow.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
                echo "<br /><a href=?page=1>首頁</a> ";
                echo "第 ";
                for( $i=1 ; $i<=$pages ; $i++ ) {
                        echo "<a href=?page=$i>$i</a> ";
                } 
                echo " 頁 <a href=?page=$pages>末頁</a>";
                ?>
            </div>
        </div>
    </center>    
    <?php dbclose() ?>
    </body>
</html>
