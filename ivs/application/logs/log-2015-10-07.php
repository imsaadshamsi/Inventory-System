<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-10-07 17:16:15 --> Query error: Unknown column 'unitid' in 'where clause' - Invalid query: SELECT  SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID  FROM Shelving WHERE unitid=2
ERROR - 2015-10-07 17:16:39 --> Query error: Unknown column 'unitid' in 'where clause' - Invalid query: SELECT  SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID  FROM Shelving WHERE unitid=2
ERROR - 2015-10-07 17:16:59 --> Query error: Unknown column 'unitid' in 'where clause' - Invalid query: SELECT  SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID  FROM Shelving WHERE unitid=2
ERROR - 2015-10-07 17:21:28 --> Query error: Unknown column 'unitid' in 'where clause' - Invalid query: SELECT  SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID  FROM Shelving WHERE unitid=2
ERROR - 2015-10-07 17:21:43 --> Query error: Unknown column 'unitid' in 'where clause' - Invalid query: SELECT  SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID  FROM Shelving WHERE unitid=2
ERROR - 2015-10-07 17:53:22 --> Severity: Warning --> Missing argument 1 for Inventory::index_get() C:\xampp\htdocs\ivs\application\controllers\Inventory.php 26
ERROR - 2015-10-07 17:53:22 --> Severity: Notice --> Undefined variable: c C:\xampp\htdocs\ivs\application\controllers\Inventory.php 33
ERROR - 2015-10-07 17:53:22 --> Severity: Warning --> Missing argument 2 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:22 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:22 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:22 --> Severity: Notice --> Undefined variable: limit C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=,' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=,
ERROR - 2015-10-07 17:53:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ivs\system\core\Exceptions.php:272) C:\xampp\htdocs\ivs\system\core\Common.php 569
ERROR - 2015-10-07 17:53:28 --> Severity: Warning --> Missing argument 2 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:28 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:28 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:28 --> Severity: Notice --> Undefined variable: limit C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=,' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=,
ERROR - 2015-10-07 17:53:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ivs\system\core\Exceptions.php:272) C:\xampp\htdocs\ivs\system\core\Common.php 569
ERROR - 2015-10-07 17:53:37 --> Severity: Warning --> Missing argument 2 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:37 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:53:37 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:37 --> Severity: Notice --> Undefined variable: limit C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:53:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=,' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=,
ERROR - 2015-10-07 17:53:37 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ivs\system\core\Exceptions.php:272) C:\xampp\htdocs\ivs\system\core\Common.php 569
ERROR - 2015-10-07 17:54:25 --> Severity: Warning --> Missing argument 2 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:54:25 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:54:25 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:54:25 --> Severity: Notice --> Undefined variable: limit C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:54:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=,' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=,
ERROR - 2015-10-07 17:54:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ivs\system\core\Exceptions.php:272) C:\xampp\htdocs\ivs\system\core\Common.php 569
ERROR - 2015-10-07 17:54:27 --> Severity: Warning --> Missing argument 2 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:54:27 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 48 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 17:54:27 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:54:27 --> Severity: Notice --> Undefined variable: limit C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:54:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=,' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=,
ERROR - 2015-10-07 17:54:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ivs\system\core\Exceptions.php:272) C:\xampp\htdocs\ivs\system\core\Common.php 569
ERROR - 2015-10-07 17:55:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=1,20' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) LIMIT=1,20
ERROR - 2015-10-07 17:56:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=1,20 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 LIMIT=1,20 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) 
ERROR - 2015-10-07 17:57:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=20 OFFSET1 ORDER BY (CASE status
                            WHEN "AVAILABLE" ' at line 1 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 LIMIT=20 OFFSET1 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END) 
ERROR - 2015-10-07 17:59:01 --> Severity: Parsing Error --> syntax error, unexpected ';' C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 17:59:18 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=20 OFFSET1' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=19 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END)  LIMIT=20 OFFSET1
ERROR - 2015-10-07 17:59:46 --> Severity: Error --> Call to undefined method InventoryDAO::getCount() C:\xampp\htdocs\ivs\application\controllers\Inventory.php 54
ERROR - 2015-10-07 18:01:01 --> Severity: Error --> Call to undefined method InventoryDAO::getCount() C:\xampp\htdocs\ivs\application\controllers\Inventory.php 54
ERROR - 2015-10-07 18:01:43 --> Severity: Error --> Call to undefined method InventoryM::fetch_inventory() C:\xampp\htdocs\ivs\application\controllers\Inventory.php 63
ERROR - 2015-10-07 18:02:10 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 62 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 18:02:10 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 18:02:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=20 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END)  LIMIT 1 OFFSET 
ERROR - 2015-10-07 18:03:10 --> Severity: Warning --> Missing argument 3 for InventoryM::GetAllInventory(), called in C:\xampp\htdocs\ivs\application\controllers\Inventory.php on line 62 and defined C:\xampp\htdocs\ivs\application\models\InventoryM.php 21
ERROR - 2015-10-07 18:03:10 --> Severity: Notice --> Undefined variable: start C:\xampp\htdocs\ivs\application\models\InventoryM.php 27
ERROR - 2015-10-07 18:03:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED  FROM INVENTORY WHERE unitid=20 ORDER BY (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END)  LIMIT 1 OFFSET 
ERROR - 2015-10-07 18:03:53 --> Severity: Notice --> Object of class CI_DB_mysqli_result could not be converted to int C:\xampp\htdocs\ivs\system\libraries\Pagination.php 402
ERROR - 2015-10-07 18:03:53 --> Severity: Notice --> Object of class CI_DB_mysqli_result could not be converted to int C:\xampp\htdocs\ivs\system\libraries\Pagination.php 408
ERROR - 2015-10-07 18:10:14 --> Severity: Error --> Cannot use object of type CI_DB_mysqli_result as array C:\xampp\htdocs\ivs\application\controllers\Inventory.php 56
