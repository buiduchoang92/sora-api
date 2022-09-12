<?php

interface ISqlConnect {
    /**
     * The method is run query when connect with database, use with statement select 
     * Return result
     */
    public function executeQuery ();
    
    /**
     * The method is run querry when connect with database, use with statement insert, delete, update,...
     * No return result
     */
    public function updateQuery();
    
    /**
     * The method help set new query before run
     */
    public function  addQuery($param);
}