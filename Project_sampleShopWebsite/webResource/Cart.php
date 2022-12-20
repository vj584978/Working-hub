<!DOCTYPE html>
<?php 
include_once 'member.inc';
session_start();
if(@$_SESSION['cart']!==NULL)
{$num=count($_SESSION['cart']);}
$sqlproductrow="select * from products";
$sqlres= dbQuery($sqlproductrow);
$trown=$sqlres->num_rows;
isLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>購物車</title>
        <style>
            #cart{
                height: 750px;
            }
            select{
                width: 100%;
            }
        </style>
        <script>
            function countTotal()
            {
                for(var i=0;i<(<?php echo $trown ?>);i++)
                    {
                        if(document.getElementById('price'+i)===null)
                        {continue;}
                        else
                        {
                            var price=document.getElementById('price'+i).innerHTML;
                            var amout=document.getElementById('amout'+i).value;
                            document.getElementById('total'+i).innerHTML=price*amout;
                        }
                    }
                countTotalAll();
            }
            function countTotalAll()
            {
                var total=[];
                var totalSum=0;
                for(var i=0;i<(<?php echo $trown?>);i++)
                {
                    if(document.getElementById('total'+i)===null)
                    {continue;}
                    else
                    {total[i]=Number(document.getElementById('total'+i).innerHTML);}
                }
                var totalLen=total.length;
                for(var c=0;c<totalLen;c++)
                {
                    if(isNaN(total[c]))
                    {continue;}
                    else  
                    {totalSum+=total[c];}
                }
                document.getElementById('countAll').innerHTML=totalSum;
            }
        </script>
    </head>
    <body onload="countTotal()">
        <center>
            <div id="cart">
                <h1>購物車</h1>
                <form method="GET" action="">
                    <table border="2" id="cartTable">
                        <thead>
                            <th style="width:80px;">商品名稱</th>
                            <th style="width:70px;">單價</th>
                            <th>庫存</th>
                            <th>訂購數量</th>
                            <th style="width:70px;">小計</th>
                            <th>操作</th>
                        </thead>
                        <?php
                            if(isset($_GET['del']))
                            {
                                $del=$_GET['del'];
                                unset($_SESSION['cart'][$del]);
                                //echo "<script language='javascript'>setTimeout(()=>{location.href='Cart.php'},100)</script>";
                                
                            }
                            if(isset($_SESSION['cart']))
                            {
                                $s=$_SESSION['cart'];
                                $sCount=count($s);
                                for($k=0;$k<$trown;$k++)
                                {
                                    if(!isset($s[$k]))
                                    {
                                        continue;
                                    }
                                    else
                                    {
                                        $cart="select 產品編號,產品名稱,價格,庫存量 from 商品總表 where 產品編號 = '$s[$k]'";
                                        $cartResult=dbQuery($cart);
                                        $rowCart=$cartResult->fetch_assoc();
                                        echo "<tr>";
                                        echo "<td>".$rowCart['產品名稱']."<input type='hidden' name='itemId[]' value='".$rowCart['產品編號']."'/></td>";
                                        echo "<td id='price$k' name='price' align='center'>".$rowCart['價格']."</td>";
                                        echo "<td align='center'>".$rowCart['庫存量']."</td>";
                                        echo "<td><select id='amout$k' name='amout[]' onchange='countTotal()'>";
                                            for($t=1;$t<($rowCart['庫存量']+1);$t++)
                                            {echo "<option value='$t'>$t</option>";}
                                        echo "</td>";
                                        echo "<td id='total$k' align='right'></td>";
                                        echo "<td id='del$k'><a href=?del=$k>刪除</a></td>";
                                        echo "</tr>";   
                                    }
                                }
                            }                     

                            
                        ?>
                        <tfoot>
                            <tr>
                                <td colspan="6" align="right">
                                    <a href="Order.php"><input type="button" value="回到選購清單"/></a>
                                    <input type="submit" name="btnCleanCart" value="清空購物車"/>
                                    <?php if(isset($_GET['btnCleanCart'])){session_unset();echo "<script language='javascript'>setTimeout(()=>{location.href='Cart.php'},100)</script>";}?>
                                    <input type="submit" name="btnIwantThose" value="結帳"/><br/>
                                    <?php
                                        if(isset($_GET['btnIwantThose']))
                                        {
                                            if(isset($_SESSION['cart']))
                                            {
                                                unset($_SESSION['buyConformId']);
                                                unset($_SESSION['buyConformAmout']);
                                                for($k=0;$k<$num;$k++)
                                                {
                                                    $_SESSION['buyConformId'][$k]=$_GET['itemId'][$k];
                                                    $_SESSION['buyConformAmout'][$k]=$_GET['amout'][$k];
                                                    echo "<script language='javascript'>setTimeout(()=>{location.href='BuyIt.php'},100)</script>";
                                                }
                                            }else
                                            {echo "購物車內沒有商品喔~";}
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"></td>
                                <td>總金額：</td>
                                <td align="right" id="countAll"></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </center>
    <?php dbclose() ?>
    </body>
</html>
