<?php

class topics
{
	 function __construct() 
	 {
        $this->WIdb = WIdb::getInstance();
        $this->valid = new valid();
        $this->mw = new middleware();
      }

      
}
?>