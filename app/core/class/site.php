<?php

class site
{
	
	public function startUp()
	{
		echo '<!DOCTYPE html>
				<html lang="en">

				<head>
				  <meta charset="UTF-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1.0">
				  <meta http-equiv="X-UA-Compatible" content="ie=edge">
				  
				  <!-- Custom Styles -->
				  <link rel="stylesheet" href="css/style.css">
				  <link rel="stylesheet" href="css/carousal.css">
				  <title>Inspires Blog</title>
				</head>
				<body>';
	}

	public function header()
	{
		echo '<header class="clearfix">
    <div class="logo">
      <a href ="' .BASE_URL . '/index.php">
        <h1 class="logo-text"><span>Inspires</span>Blog</h1>
      </a>
    </div>
    <div class="fa fa-reorder menu-toggle"></div>
    <nav>
      <ul>
        <li><a href="'.BASE_URL . '/index.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>';
         
        if(isset($_SESSION['id'])):

        '<li>
          <a href="#" class="userinfo">
            <i class="fa fa-user"> </i>
            '.$_SESSION['username'].'
            <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown">';
            if($_SESSION['admin']):

            echo '<li><a href="'.BASE_URL . '/admin/dashboard.php">Dashboard</a></li>';
            endif;
            echo '<li><a href="'. BASE_URL . '/logout.php" class="logout">Logout</a></li>
          </ul>
        </li>';
    else:
         echo '<li><a href="'. BASE_URL . '/register.php">Sign up</a></li>
         <li><a href="'. BASE_URL . '/login.php"><i class="fa fa-sign-in"></i>Login</a></li>';
         
     endif;
      echo '</ul>
    </nav>
  </header>';
	} 
}