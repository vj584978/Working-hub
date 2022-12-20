<!DOCTYPE html>
<!--連結inc設定黨-->
<?php 
include_once 'member.inc';
session_start();
isLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>商品訂購</title>
        <style>
            #productlist{
                height: 750px;
            }
            select{
                width: 100%;
            }
            table{
                width: 80%;
            }
        </style>
        <script language="javascript">
            
        </script>
    </head>
    <body>
        <center>
            <div id="box">
                <div id="productlist">
                    <h1>商品目錄</h1>
                    <?php
                    //SQL操作
                    $productLayOut="select * from products";
                    $result=dbQuery($productLayOut);
                    $totalrow=$result->num_rows;
                    $per=20;
                    $pages= ceil($totalrow/$per);
                    if(!isset($_GET['page']))
                    {$page=1;}
                    else 
                    {$page= intval($_GET['page']);}
                    $start=($page-1)*$per;
                    $split="$productLayOut limit $start,$per;";
                    $splitresult=dbQuery($split);
                    ?>
                    <?php 
                    if(isset($_GET['btnAddCart']))
                        {
                            if(!isset($_SESSION['cart']))
                            {$_SESSION['cart']=array();}
                            $oriSession=$_SESSION['cart'];
                            $getAddCart=@$_GET['addCart'];
                            if($getAddCart!==NULL)
                            {
                                $getAddCartLen=count($getAddCart);
                                for($a=0;$a<@$getAddCartLen;$a++)
                                {
                                    if(!isset($getAddCart[$a]))
                                    {continue;}
                                    else
                                    {
                                        for($b=0;$b<count($oriSession);$b++)
                                        {
                                            if(isset($oriSession[$b]))
                                            {
                                                if((int)$getAddCart[$a]===(int)$oriSession[$b])
                                                {
                                                    unset($getAddCart[$a]);
                                                    break;
                                                }
                                            } else
                                            {
                                                continue;
                                            }
                                        }
                                    }
                                }
                                $_SESSION['cart'] = array_merge($oriSession,$getAddCart);
                            }
                        }
                    ?>
                    <form method="GET" action="Order.php">
                        <table border="2">
                            <thead>
                                <th>商品名稱</th>
                                <th>單位</th>
                                <th>價錢</th>
                                <th>購買</th>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row=$splitresult->fetch_row())
                                        {
                                            echo "<tr>";
                                            echo "<td>$row[1]</td>";
                                            echo "<td>$row[2]</td>";
                                            echo "<td>$row[3]</td>";
                                            echo "<td align='center'><input type='checkbox' class='checkbox' name='addCart[]' value='$row[0]'/></td>";
                                            echo "</tr>";
                                        }
                                ?>
                                <tr>
                                    <td colspan='4' align='right'>
                                        <input type='submit' name='btnAddCart' value='加入購物車'/>
                                        <a href='Cart.php'><input type='button' name='btnGoCart' value='前往購物車'/></a><br/>
                                        <?php 
                                        if(isset($_GET['btnAddCart']) || isset($_SESSION['cart']))
                                        {
                                            $cartAmout=count($_SESSION['cart']);
                                            echo "購物車內有 <font size='+3' color='red'>$cartAmout</font> 項商品等著你結帳</td>";
                                        }
                                        ?>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    //分頁頁碼
                    echo '共 '.$totalrow.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
                    echo "<br /><a href=?page=1>首頁</a> ";
                    echo "第 ";
                    for( $i=1 ; $i<=$pages ; $i++ ) {
                            echo "<a href=?page=$i>$i</a> ";
                    } 
                    echo " 頁 <a href=?page=$pages>末頁</a><br/>";
                    ?>
                    
                </div>
            </div>
        </center>    
    <?php dbclose() ?>
    </body>
</html>
