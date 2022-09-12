<?php

require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'products' . DS . 'ComputerProduct.php';
require_once ROOT . DS . 'services' . DS . 'products' . DS . 'ProductServices.php';

class ComputerProductServices extends ProductServices {
    /**
     * The method support insert data to database
     * @param ComputerProduct $computerProduct
     */
    public function insert($computerProduct) {
        // add to products table
        parent::insert($computerProduct);
                        
        // add to computer_products table
        $query = "insert into computer_products(product_id, s_cpu, s_ram, s_storage, screen, s_card, main_connection, os)
                    value (" .
                    $computerProduct->getProductID() . "," .
                    "'" . $computerProduct->getCpu() . "' ," .
                    "'" . $computerProduct->getRam() . "' ," .
                    $computerProduct->getStorage() . "," .
                    "'" . $computerProduct->getScreen() . "' ," .
                    "'" . $computerProduct->getCard() . "' ," .
                    "'" . $computerProduct->getMainConnection() . "' ," .
                    "'" . $computerProduct->getOs() . "'"
                        . ")";
        parent::addQuery($query);
        parent::updateQuery();
    }
    
    /**
     * The method update data to database
     * @param ComputerProduct $computerProduct
     */
    public function update($computerProduct) {
        // update to products table
        parent::update($computerProduct);
        
        // update to computer_products table
        $query = "update computer_products
                    set " .
                    "s_cpu = " . "'" . $computerProduct->getCpu() . "' ," .
                    "s_ram = " . "'" . $computerProduct->getRam() . "' ," .
                    "s_storage = " . $computerProduct->getStorage() . "," .
                    "screen = " . "'" . $computerProduct->getScreen() . "' ," .
                    "s_card = " . "'" . $computerProduct->getCard() . "' ," .
                    "main_connection = " . "'" . $computerProduct->getMainConnection() . "' ," .
                    "os = " . "'" . $computerProduct->getOs() . "'" .
                    "where product_id = " . $computerProduct->getProductID()
                    . "";

        parent::addQuery($query);
        parent::updateQuery();             
    }
}



