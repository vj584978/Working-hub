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
            table{
                border:1px blue solid;
                width: 90%;
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
                    <table border="2">
                        <?php
                            if(isset($_GET['btnProductSearch']))
                                {
                                    if($_GET['productId']!=="")
                                    {
                                    $productId=$_GET['productId'];
                                    $productSearch="select * from products where pid = $productId;";
                                    $result=dbQuery($productSearch);
                                    $row=$result->fetch_assoc();
                                    }
                                }
                            if(isset($_GET['btnProductUpdate']))
                                {
                                    $productId=$_GET['productId'];
                                    $productName=$_GET['productName'];
                                    $productUnit=$_GET['productUnit'];
                                    $productPrice=$_GET['productPrice'];
                                    $productSupplier=$_GET['productSupplier'];
                                    $productCategory=$_GET['productCategory'];
                                    $productUpdate="UPDATE `system`.`products` SET `name` = '$productName',
                                                    `unit` = '$productUnit', `price` = '$productPrice', `suplierid` = '$productSupplier',
                                                    `categoryid` = '$productCategory' WHERE (`pid` = '$productId');";
                                    $result=dbQuery($productUpdate);
                                }
                            if(isset($_GET['btnProductDelete']))
                                {
                                    $productId=$_GET['productId'];
                                    $productDelete="DELETE FROM `system`.`products` WHERE (`pid` = '$productId');";
                                    $result=dbQuery($productDelete);
                                }
                            if(isset($_GET['btnProductInsert']))
                                {
                                    $productNameInsert=$_GET['productNameInsert'];
                                    $productUnitInsert=$_GET['productUnitInsert'];
                                    $productPriceInsert=$_GET['productPriceInsert'];
                                    $productSupplierInsert=$_GET['productSupplierInsert'];
                                    $productCategoryInsert=$_GET['productCategoryInsert'];
                                    $productInsert="INSERT INTO `system`.`products` (`name`, `unit`, `price`, `suplierid`, `categoryid`)
                                                    VALUES ('$productNameInsert', '$productUnitInsert', '$productPriceInsert',
                                                     '$productSupplierInsert', '$productCategoryInsert');";
                                    $result=dbQuery($productInsert);
                                }
                                ?>        
                                <tr>
                                    <td>商品搜尋</td>
                                    <td>
                                        <input type="text" name="productId" class="serachInput" placeholder="請輸入商品編號" value="<?= @$row['pid'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>商品名稱</td>
                                    <td>
                                        <input type="text" name="productName" class="serachInput" value="<?= @$row['name'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>單位</td>
                                    <td>
                                        <input type="text" name="productUnit" class="serachInput" value="<?= @$row['unit'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>價錢</td>
                                    <td>
                                        <input type="text" name="productPrice" class="serachInput" value="<?= @$row['price'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供應商：</td>
                                    <td>
                                        <select name="productSupplier" class="serachInput">
                                            <option value="未填寫" selected disabled>--請選擇供應商--</option>
                                            <?php
                                            $layoutSupplierList="select id,name from supplier";
                                            $results= dbQuery($layoutSupplierList);
                                            while($rows=$results->fetch_row())
                                            {
                                                if($row['suplierid']==$rows[0])
                                                {echo "<option value={$rows[0]} selected>{$rows[1]}</option>";}
                                                else
                                                {echo "<option value={$rows[0]}>{$rows[1]}</option>";}
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>類別：</td>
                                    <td>
                                        <select name="productCategory" class="serachInput">
                                            <option value="未填寫" selected disabled>--請選擇類別--</option>
                                            <?php
                                            $layoutCategoryList="select id,category from category";
                                            $resultc= dbQuery($layoutCategoryList);
                                            while($rowc=$resultc->fetch_assoc()) //傳回陣列
                                                {
                                                    if($row['categoryid']==$rowc['id'])
                                                    {echo "<option value={$rowc['id']} selected>{$rowc['category']}</option>";}
                                                    else
                                                    {echo "<option value={$rowc['id']}>{$rowc['category']}</option>";}
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnProductSearch" value="　搜尋　"/>
                                        <input type="submit" name="btnProductUpdate" value="更新商品"/>
                                        <input type="submit" name="btnProductDelete" value="刪除商品"/>
                                    </td>
                                </tr>
                                <tr><td colspan="2" style="background-color: black; "></td></tr>
                                <tr>
                                    <td>商品名稱</td>
                                    <td>
                                        <input type="text" name="productNameInsert" class="serachInput"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>單位</td>
                                    <td>
                                        <input type="text" name="productUnitInsert" class="serachInput"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>價錢</td>
                                    <td>
                                        <input type="text" name="productPriceInsert" class="serachInput"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供應商：</td>
                                    <td>
                                        <select name="productSupplierInsert" class="serachInput">
                                            <option value="未填寫" selected disabled>--請選擇供應商--</option>
                                            <?php
                                            $layoutSupplierList="select id,name from supplier";
                                            $results= dbQuery($layoutSupplierList);
                                            while($rows=$results->fetch_row())
                                            {
                                                echo "<option value={$rows[0]}>{$rows[1]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>類別：</td>
                                    <td>
                                        <select name="productCategoryInsert" class="serachInput">
                                            <option value="未填寫" selected disabled>--請選擇類別--</option>
                                            <?php
                                            $layoutCategoryList="select id,category from category";
                                            $resultc= dbQuery($layoutCategoryList);
                                            while($rowc=$resultc->fetch_assoc()) //傳回陣列
                                                {
                                                    echo "<option value={$rowc['id']}>{$rowc['category']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnProductInsert" class="btnSerachInput" value="新增商品"/>
                                    </td>
                                </tr>
                            </table>
                        </form>        
            </div>
            <div id="show">
                <?php
                //SQL操作
                $productLayOut="select 產品編號,產品名稱,單位,價格,類別,供應商名稱 as 供應商 from 商品表";
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
                <table>
                    <thead>
                        <?php
                            while($rowtop=$result->fetch_field())
                            {echo "<th>$rowtop->name</th>";}
                        ?>
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
