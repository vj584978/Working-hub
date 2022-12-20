<!DOCTYPE html>
<?php 
include_once 'member.inc';
session_start();
$num=count($_SESSION['buyConformId']);
isLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>結帳</title>
        <script>
            function countTotal()
            {
                setTimeout
                (()=>
                {
                    for(var i=0;i<(<?php echo $num;?>);i++)
                    {
                        var price=Number(document.getElementById('price'+i).innerHTML);
                        var amout=Number(document.getElementById('amout'+i).innerHTML);
                        document.getElementById('total'+i).innerHTML=price*amout;
                    }
                    countTotalAll();
                },100);
            }
            function countTotalAll()
            {
                var total=[];
                var totalSum=0;
                for(var i=0;i<(<?php echo $num;?>);i++)
                {
                    total[i]=document.getElementById('total'+i).innerHTML;
                }
                var totalLen=total.length;
                for(var c=0;c<totalLen;c++)
                {
                    totalSum+=Number(total[c]);
                }
                document.getElementById('countAll').innerHTML=totalSum;
                document.getElementById('countAllinput').value=totalSum;
            }
        </script>
    </head>
    <body onload="countTotal()">
        <center>
            <div id="box">
                <h1>我要這些!!</h1>
                <form method="GET" action="<?php $_SERVER['PHP_SELF']?>">
                    <table border="2">
                        <thead>
                            <th style="width:80px;">商品名稱</th>
                            <th style="width:70px;">單價</th>
                            <th>訂購數量</th>
                            <th style="width:50px;">小計</th>
                        </thead>
                        <?php
                            if(isset($_SESSION['buyConformId']))
                            {
                                $buyId=@$_SESSION['buyConformId'];  
                                $buyAmout=@$_SESSION['buyConformAmout'];
                                for($k=0;$k<count($buyId);$k++)
                                {
                                    $cart="select 產品編號,產品名稱,價格,庫存量 from 商品總表 where 產品編號 = '$buyId[$k]'";
                                    $cartResult=dbQuery($cart);
                                    $rowCart=$cartResult->fetch_assoc();
                                    echo "<tr>";
                                    echo "<td>".$rowCart['產品名稱']."</td>";
                                    echo "<td id='price$k' name='price' align='center'>".$rowCart['價格']."</td>";
                                    echo "<td id='amout$k' name='amout[]' align='center'>$buyAmout[$k]</td>";
                                    echo "<td id='total$k' align='right'></td>";
                                    echo "</tr>";
                                }                     
                            }
                            if(isset($_GET['btnIwantThose']))
                            {
                                $totalPrice=$_GET['countAll'];
                                $orderIndexInsert="INSERT INTO `system`.`orderindex` (`buyer`,`totalprice`) VALUES ('{$_COOKIE['login'][0]}','$totalPrice');";
                                $orderInsert= dbQuery($orderIndexInsert);
                                $orderNumSQL="select * from orderindex";
                                $orderNumResult= dbQuery($orderNumSQL);
                                $orderNum=$orderNumResult->num_rows;
                                $product=$_SESSION['buyConformId'];
                                $amout=$_SESSION['buyConformAmout'];
                                for($i=0;$i<$num;$i++)
                                {
                                    $orderContentInsert="INSERT INTO `system`.`ordercontent` (`id`, `product`, `amout`) VALUES ('$orderNum', '$product[$i]', '$amout[$i]');";
                                    dbQuery($orderContentInsert);
                                }
                                echo "<script>alert('訂購完成，此筆訂單編號為$orderNum');location.href='Cart.php'</script>";
                                session_unset();
                            }
                        ?>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="right">
                                    <a href="Cart.php"><input type="button" value="回到購物車"/></a>
                                    <input type="submit" name="btnIwantThose" value="確認訂購"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"></td>
                                <td>總金額：<input type='hidden' id="countAllinput" name="countAll"/></td>
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
