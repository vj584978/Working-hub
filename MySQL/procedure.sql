/*
Delimiter ##
# 設定結束符號為##
create procedure selectProduct(in id int)
begin
	select * from products where pid=id;
end ##
# 創建程序名稱(參數)及SQL程式碼(begin後 end前)

call selectProduct(15)
# 呼叫程序並啟動，參數設定15=將15填入程式碼中執行
*/

/*
Delimiter %%
create procedure selectOrder(in id int)
begin
	select * from order_detail where pid=id;
end %%

call selectOrder(42);
# 設定為其他字符測試
*/

/*
Delimiter %%
create procedure InsertSupplier()
begin
	insert into supplier set
    name = '統二化工廠', saleman = '7-11';
end %%

call InsertSupplier()
*/

/*
Delimiter %%
create procedure InsertSupplierD(in n varchar(45),in s varchar(45))
begin
	insert into supplier set
    name = n, saleman = s;
end %%

call InsertSupplierD('小桶','大同')
# 以參數輸入方式加入資料
*/

# call insertcategory('東西貨');

/*
Delimiter %%
create procedure selectOederAll( in pid int, out total int)
begin
select sum(合計) into total from 訂單總表 where  產品編號=pid;
end%%
# 回傳值寫法.將結果回傳至total

call selectOederAll(42,@total);
select @total;
select @total as 糙米銷售總額;
# 用42帶入執行並輸出
*/
