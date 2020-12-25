<?php 

 $page = "index";

include_once 'app/includes/start_up.php';

$site->header();

include_once 'app/includes/pages/'. $page .'.php';

$site->footer();
  
   ?>
</body>
</html>
 <script src="js/carousal.js"></script>