<?php 

 $page = "register";

include_once 'app/includes/start_up.php';

$site->header();

if(session::get("user_id")){
  header('location: ' . BASE_URL . ' '. redirect);
}else{
  include_once 'app/includes/pages/'. $page .'.php';
}


$site->footer();
  
   ?>
</body>
</html>
 