<?php
//echo dirname(dirname(dirname(__FILE__))) .'/app/core/init.php';
include_once dirname(dirname(dirname(__FILE__))) .'/app/core/init.php';

$site->StartUp();
$site->meta($page);
$site->css($page);
$site->scripts($page);
?>


</head>
<body>
