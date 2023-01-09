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
            table{
                border:1px blue solid;
                width: 80%;
            }
            th{
                border:1px black solid;
            }
            td{
                border: 1px black solid;
            }
        </style>
    </head>
    <body>
    <center>
        <?php
        //SQL操作
        $productLayOut="SELECT * FROM 商品總表 order by 產品編號 asc";
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
    </center>    
    </body>
</html>
