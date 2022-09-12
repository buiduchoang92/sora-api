\! echo "Start migration";
\! echo "Add 1 new columns into customers table";
ALTER TABLE `customer` 
    ADD `token_jwt` VARCHAR(255) NULL DEFAULT NULL AFTER `login_id`;

CREATE TRIGGER `TRIGGER_UPDATE_BEFORE_ITEMS` BEFORE UPDATE ON `items`