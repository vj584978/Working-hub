# create view `數量>=50` as select * from order_detail where qty>=50;
# 建立view檢視表

##練習 分別建立訂單明細、產品、類別、供應商 並將各欄位以中文呈現
# create view `供應商` as select id as 供應商編號, name as 供應商名稱, saleman as 銷售員 from supplier;
# create view 類別 as select id as 類別編號, category as 類別 from category;
# create view `產品` as select pid as 產品編號, name as 產品名稱, unit as 單位, price as 單價, suplierid as 供應商編號, categoryid as 類別編號 from products;
# create view `訂單明細` as select id as 訂單編號, pid as 商品編號, qty as 數量 from order_detail;

##練習 建立訂單總表之檢視表、包含:訂單編號/產品編號/產品名稱/單位/類別/供應商名稱/銷售人員/價格/數量/合計
/*
create view 訂單總表 as
select order_detail.id as 訂單編號, products.pid as 產品編號, products.name as 產品名稱, products.unit as 單位,
	   category.category as 類別, supplier.name as 供應商名稱, supplier.saleman as 銷售人員,
       price as 價格, qty as 數量, (price * qty) as 合計 
from products inner join order_detail on products.pid=order_detail.pid 
inner join category on products.categoryid=category.id
inner join supplier on products.suplierid=supplier.id;
*/

