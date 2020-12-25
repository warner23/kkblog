<?php

class topics
{
	 function __construct() 
	 {
        $this->db = Db::getInstance();
        $this->valid = new valid();
        $this->mw = new middleware();
      }

      function blogTopics()
      {
      	$results = $this->db->select("SELECT * FROM `topics`");

      	foreach ($results as $key => $topic){
      		echo ' <li><a href="'.BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'].'">'.$topic['name'].'</a></li>';
      	}
              
            
      }

    

      
}
?>