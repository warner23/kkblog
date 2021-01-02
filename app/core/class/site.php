<?php

class Site
{

	    function __construct() 
    {
      //db instance
       $this->db = Db::getInstance();
       $this->Login = new Login();
       $this->User = new User(Session::get("user_id"));
    }
	public function startUp()
	{
		echo '<!DOCTYPE html>
				<html lang="en">

				<head>
        <title>' . name . ' </title>
				  <meta charset="UTF-8">
				  <meta http-equiv="X-UA-Compatible" content="ie=edge">';
	}

  public function meta($page)
  {
          $result = $this->db->select("SELECT * FROM `meta` WHERE `page`=:page",
          array(
            "page" => $page
          )
        );

         foreach($result as $res)
        {
            echo '<meta name="' . $res['name'] . '" content="' . $res['content'] . '">';
            
        }
  }

  public function css($page)
  {
      $result = $this->db->select("SELECT * FROM `css` WHERE `page`=:page",
          array(
            "page" => $page
          )
        );

        foreach($result as $res)
        {
        echo '<link href="' . $res['href'] . '" rel="stylesheet">';
        }
  }

  public function scripts($page)
  {
      $result = $this->db->select("SELECT * FROM `scripts` WHERE `page`=:page",
          array(
            "page" => $page
          )
        );

        foreach($result as $res)
        {
        echo ' <script src="' . $res['src'] . '" type="text/javascript"></script>';
        }

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
      <ul>';

        echo '<li><a href="'.BASE_URL . '/index.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>';
         
         if($this->Login->isLoggedIn() ){
          '<li>
          <a href="#" class="userinfo">
            <i class="fa fa-user"> </i>';
            $this->User->getUsername(Session::get("user_id"));
           echo '<i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown">';
        }else if($this->User->isAdmin() ){
          echo '<li><a href="'.BASE_URL . '/admin/dashboard.php">Dashboard</a></li>';
          
            echo '<li><a href="'. BASE_URL . '/logout.php" class="logout">Logout</a></li>
          </ul>
        </li>';

      }else{
        echo '<li><a href="'. BASE_URL . '/register.php">Sign up</a></li>
         <li><a href="'. BASE_URL . '/login.php"><i class="fa fa-sign-in"></i>Login</a></li>';
      }
        
            

      echo '</ul>
    </nav>
  </header>';
	} 


  function footer()
  {
    echo '  <div class="footer">
    <div class="footer-content">
      <div class="footer-section about">
        <h1 class="logo-text">Awa<span>Inspires</span></h1>
        <p>
          AwaInspires is a fictional blog conceived for the purpose
          of a tutorial on YouTube. However, Awa has a blog called pieceofadvice.org
          where he writes truly inspiring stuff.
        </p>
        <!-- <br> -->
        <div class="contact">
          <i class="fa fa-phone"> &nbsp; 123-456-789</i>
          <i class="fa fa-envelope"> &nbsp; info@mywebsite.com</i>
        </div>
        <div class="social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-youtube-play"></i></a>
        </div>
      </div>
      <div class="footer-section quick-links">
        <h2>QUICK LINKS</h2>
        <ul>
          <a href="#">
            <li>Events</li>
          </a>
          <a href="#">
            <li>Contact</li>
          </a>
          <a href="#">
            <li>Mentors</li>
          </a>
          <a href="#">
            <li>Galleries</li>
          </a>
          <a href="#">
            <li>Write for us</li>
          </a>
          <a href="#">
            <li>Terms and conditions</li>
          </a>
        </ul>
      </div>
      <div class="footer-section contact-form-div">
        <h2>Contact Us</h2>
        <br>
        <form action="index.php" method="post">
          <input type="text" name="email-address" class="text-input contact-input" placeholder="Your email address">
          <textarea name="message" cols="30" rows="3" class="text-input contact-input" placeholder="Message..."></textarea>
          <button type="submit" name="send-msg-btn" class="send-msg-btn">
            <i class="fa fa-send"></i> Send
          </button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© Coding Poets | Designed by Awa</p>
    </div>
  </div>';
  }
}