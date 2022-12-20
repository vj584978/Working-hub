<!DOCTYPE html>
<?php 
include_once 'BaAdm.inc';
adisLogin_cookie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>類別/供應商查改</title>
        <link rel="stylesheet" href="btnCss.css" >
        <style>
            *{
                box-sizing: border-box;
            }
            #box{
                border: 2px black solid;
                width: 100%;
                height: 825px;
                display: flex;
                justify-content: center;
            }
            #category,#supplier{
                border: 2px black solid;
                width: 50%;
                height: 100%;
            }
            .edit{
                border-bottom: 2px blue dotted;
                height: 40%;
                margin: 10px;
            }
            .edit table{
                width: 100%;
            }
            .edit table .serachInput{
                width: 80%;
            }
            .show{
                overflow-y: scroll;
                height: 57%;
            }
            .show table{
                width: 50%;
                
            }
        </style>
    </head>
    <body>
        <center>
            <div id="box">
                <div id="category">
                    <div id="categoryEdit" class="edit">
                        <form method="get" action="<?php $_SERVER['PHP_SELF']?>">
                            <table border="2">
                                <?php
                                    if(isset($_GET['btnCategorySearch']))
                                        {
                                            $categoryInputId=$_GET['categoryInputId'];
                                            $CategorySearch="select * from category where id = $categoryInputId;";
                                            $result=dbQuery($CategorySearch);
                                            $row=$result->fetch_row();
                                        }
                                    if(isset($_GET['btnCategoryUpdate']))
                                        {
                                            $categoryInputId=$_GET['categoryInputId'];
                                            $categoryInputName=$_GET['categoryUpdateInputName'];
                                            $CategoryUpdate="update category set category = '$categoryInputName' where id = $categoryInputId;";
                                            $result=dbQuery($CategoryUpdate);
                                        }
                                    if(isset($_GET['btnCategoryDelete']))
                                        {
                                            $categoryInputId=$_GET['categoryInputId'];
                                            $CategoryDelete="delete from category where id = $categoryInputId;";
                                            $result=dbQuery($CategoryDelete);
                                        }
                                    if(isset($_GET['btnCategoryInsert']))
                                        {
                                            $categoryInsertInput=$_GET['categoryInsert'];
                                            $CategoryInsert="INSERT INTO `system`.`category` (`category`) VALUES ('$categoryInsertInput');";
                                            $result=dbQuery($CategoryInsert);
                                        }
                                ?>
                                <tr>
                                    <td>類別搜尋</td>
                                    <td>
                                        <input type="text" name="categoryInputId" class="serachInput" placeholder="請輸入類別編號" value="<?php echo @$row[0]; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>類別名稱</td>
                                    <td>
                                        <input type="text" name="categoryUpdateInputName" class="serachInput" value="<?php echo @$row[1]; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnCategorySearch" value="　搜尋　"/>
                                        <input type="submit" name="btnCategoryUpdate" value="更新類別"/>
                                        <input type="submit" name="btnCategoryDelete" value="刪除類別"/>
                                        
                                    </td>
                                </tr>
                                <tr><td colspan="2" style="background-color: black; "></td></tr>
                                
                                <tr>
                                    <td>新增類別</td>
                                    <td>
                                        <input type="text" name="categoryInsert" class="serachInput" placeholder="請輸入類別名稱"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnCategoryInsert" class="btnSerachInput"value="新增類別"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="categoryShow" class="show">
                        <h3>類別總表</h3>
                        <?php 
                        $categoryShow="select id as 編號,category as 類別名稱 from category";
                        $categoryShowResult=dbQuery($categoryShow);
                        ?>
                        <table border="2">
                            <thead>
                                <?php
                                    while($rowtop=$categoryShowResult->fetch_field())
                                    {echo "<th>$rowtop->name</th>";}
                                ?>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row=$categoryShowResult->fetch_row())
                                        {
                                            echo "<tr>";
                                            for($i=0;$i<count($row);$i++)
                                            {echo "<td>$row[$i]</td>";}
                                            echo "</tr>";
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="supplier">
                    <div id="supplierEdit" class="edit">
                        <form method="get" action="<?php $_SERVER['PHP_SELF']?>">
                            <table border="2">
                                <?php
                                    if(isset($_GET['btnSupplierSearch']))
                                        {
                                            $supplierInputId=$_GET['supplierInputId'];
                                            $supplierSearch="select * from supplier where id = $supplierInputId;";
                                            $result=dbQuery($supplierSearch);
                                            $row=$result->fetch_row();
                                        }
                                    if(isset($_GET['btnSupplierUpdate']))
                                        {
                                            $supplierInputId=$_GET['supplierInputId'];
                                            $supplierInputName=$_GET['supplierUpdateInputName'];
                                            $supplierUpdateInputSaleman=$_GET['supplierUpdateInputSaleman'];
                                            $supplierUpdate="update supplier set name = '$supplierInputName',saleman = '$supplierUpdateInputSaleman' where id = $supplierInputId;";
                                            $result=dbQuery($supplierUpdate);
                                        }
                                    if(isset($_GET['btnSupplierDelete']))
                                        {
                                            $supplierInputId=$_GET['supplierInputId'];
                                            $supplierDelete="delete from supplier where id = $supplierInputId;";
                                            $result=dbQuery($supplierDelete);
                                        }
                                    if(isset($_GET['btnSupplierInsert']))
                                        {
                                            $supplierInputName=$_GET['supplierInsertName'];
                                            $supplierInsertSaleman=$_GET['supplierInsertSaleman'];
                                            $supplierInsert="INSERT INTO `system`.`supplier` (`name`, `saleman`) VALUES ('$supplierInputName', '$supplierInsertSaleman');";
                                            $result=dbQuery($supplierInsert);
                                        }
                                ?>
                                <tr>
                                    <td>供應商搜尋</td>
                                    <td>
                                        <input type="text" name="supplierInputId" class="serachInput" placeholder="請輸入供應商編號" value="<?php echo @$row[0]; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供應商名稱</td>
                                    <td>
                                        <input type="text" name="supplierUpdateInputName" class="serachInput" value="<?php echo @$row[1]?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>供應商銷售員</td>
                                    <td>
                                        <input type="text" name="supplierUpdateInputSaleman" class="serachInput" value="<?php echo @$row[2]?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnSupplierSearch" value="　搜尋　"/>
                                        <input type="submit" name="btnSupplierUpdate" value="更新類別"/>
                                        <input type="submit" name="btnSupplierDelete" value="刪除類別"/>
                                    </td>
                                </tr>
                                <tr><td colspan="2" style="background-color: black; "></td></tr>
                                
                                <tr>
                                    <td>新增供應商</td>
                                    <td>
                                        <input type="text" name="supplierInsertName" class="serachInput" placeholder="請輸入供應商名稱"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>銷售員</td>
                                    <td>
                                        <input type="text" name="supplierInsertSaleman" class="serachInput" placeholder="請輸入供應商銷售員"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnSupplierInsert" class="btnSerachInput" value="新增供應商"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="supplierShow" class="show">
                        <h3>供應商總表</h3>
                        <?php 
                        $supplierShow="select id as 編號,name as 供應商名稱,saleman as 銷售員 from supplier";
                        $supplierShowResult=dbQuery($supplierShow);
                        ?>
                        <table border="2">
                            <thead>
                                <?php
                                    while($rowtop=$supplierShowResult->fetch_field())
                                    {echo "<th>$rowtop->name</th>";}
                                ?>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row=$supplierShowResult->fetch_row())
                                        {
                                            echo "<tr>";
                                            for($i=0;$i<count($row);$i++)
                                            {echo "<td>$row[$i]</td>";}
                                            echo "</tr>";
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php dbclose() ?>
        </center>
    </body>
</html>
