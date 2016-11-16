<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-10-12 15:28:20 --> The filetype you are attempting to upload is not allowed.
ERROR - 2015-10-12 15:28:20 --> Query error: Column count doesn't match value count at row 1 - Invalid query: insert into quotes(reorderid, supplierid, userid,  quoteurl, quoteamount, deliverydate, title, selected, note ) values('2','2',4,'200.00','2015-10-12','asdf','Yes','adff');
ERROR - 2015-10-12 16:43:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'inventoryname' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) ASC inventoryname 
ERROR - 2015-10-12 16:44:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC, (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
      ' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY ASC, (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END)
ERROR - 2015-10-12 16:56:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY ASC
ERROR - 2015-10-12 16:56:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19  ASC
ERROR - 2015-10-12 17:22:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'where status="AVAILABLE"' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 where status="AVAILABLE" 
