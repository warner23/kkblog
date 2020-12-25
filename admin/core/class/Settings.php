<?php

/**
* Database Class
* Created by Warner Infinity
* Author Jules Warner
*/

class Settings
{
	private $WIC = null;

    public function __construct()
    {
        $this->WIC = Lib::getInstance();

    }   

    public function Website_Info($column) 
    {


        $user_id = 1;

        $result = $this->WIC->selectColumn('SELECT * FROM `site` WHERE `id` = :user_id', array('user_id' => $user_id), $column);
        //echo $result;
        return  $result;
    }
 

}

?>