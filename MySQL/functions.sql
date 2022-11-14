/*
Delimiter %%
create function SelectProduct(total int)
returns VARCHAR(45)
deterministic
begin
	declare str varchar(45);
    if total >5000 then set str = 'A';
    elseif (total >300) then set str = 'B';
    else set str = 'C';
    end if;
    return (str);
end %%
# 建立自訂函數

select 產品名稱, SelectProduct(合計) from 訂單總表;
# 使用函數
*/

/*
##練習 建立一函數 傳入任意名稱 回傳"hello 任意名稱 你好"
Delimiter %%
create function wellcom(welname varchar(45))
returns VARCHAR(45)
deterministic
begin
    return concat('Hello',welname,'你好');
end %%

select wellcom('王八蛋')
*/

/*
##練習 建立新表，編寫一函數增加總額內顯示單位
#新增view
create view 產品銷售總表 as
select products.name as 產品名稱,price as 價格,sum(price * qty) as 總額 ,sum(qty) as 總數量 ,count(id) as 總筆數
from products right join order_detail on products.pid=order_detail.pid group by name;

#新增function
Delimiter %%
CREATE FUNCTION `addunit`(c decimal(10,1),u varchar(45)) 
RETURNS varchar(45)
DETERMINISTIC
begin
    return concat(c,' ',u);
end%%

select 產品名稱, addunit(總額,'元') as 總額 from 產品銷售總表;
select 產品名稱, addunit(價格,'元') as 價格, addunit(總額,'元') as 總額, addunit(總筆數,"筆") from 產品銷售總表;
*/

/*
# 迴圈，小心服用.小心無限迴圈
Delimiter %%
CREATE FUNCTION `loop2`(var int) RETURNS int
    DETERMINISTIC
BEGIN
	declare var int;
	mylab:loop
		set var = var + 1;
		if var <10 then
		iterate mylab;
		end if;
		leave mylab;
	end loop mylab;
	RETURN 1;
END%%
*/
/*
CREATE DEFINER=`root`@`localhost` FUNCTION `loop2`(var int) RETURNS varchar(45) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
	declare total int;
    set total = 0;
	mylab:loop
		set var = var + 1;
        set total=total + var;
		if var <10 then
		iterate mylab;
		end if;
	leave mylab;
	end loop mylab;

	RETURN concat('total',total);
    
END
待研究
*/
