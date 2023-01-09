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
                width: 90%;
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
                            if(isset($_GET['btnStorageSearch']))
                                {
                                    if($_GET['storageId']!=="")
                                    {
                                        $storageId=$_GET['storageId'];
                                        $storageSearch="select * from 庫存表 where 產品編號 = $storageId;";
                                    } 
                                    elseif($_GET['storageName']!=="")
                                    {
                                        $storageName=$_GET['storageName'];
                                        $storageSearch="select * from 庫存表 where 產品名稱 = '$storageName';";
                                    }
                                    $result=dbQuery($storageSearch);
                                    $row=$result->fetch_assoc();
                                }
                            if(isset($_GET['btnStorageUpdate']))
                                {
                                    $storageId=$_GET['storageId'];
                                    $storageAmout=$_GET['storageAmout'];
                                    $storageUpdate="UPDATE `system`.`storage` SET `amout` = '$storageAmout' WHERE (`product` = '$storageId');";
                                    $result=dbQuery($storageUpdate);
                                }
                                ?>        
                                <tr>
                                    <td>庫存查詢By編號(擇一填寫)</td>
                                    <td>
                                        <input type="text" name="storageId" class="serachInput" placeholder="請輸入商品編號" value="<?= @$row['產品編號'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>庫存查詢By名稱(擇一填寫)</td>
                                    <td>
                                        <input type="text" name="storageName" class="serachInput" placeholder="請輸入商品名稱"value="<?= @$row['產品名稱'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>庫存量</td>
                                    <td>
                                        <input type="text" name="storageAmout" class="serachInput" value="<?= @$row['庫存量'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="btnStorageSearch" value="　搜尋　"/>
                                        <input type="submit" name="btnStorageUpdate" value="更新庫存"/>
                                    </td>
                                </tr>
                            </table>
                        </form>        
            </div>
            <div id="show">
                <?php
                //SQL操作
                $productLayOut="select * from 庫存表";
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
                <?php dbclose() ?>
            </div>
        </div>
    </center>    
    </body>
</html>
