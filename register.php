<?php include('path.php');?>
<?php include(ROOT_PATH .'/app/controllers/users.php');
guestsOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

 

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>Register</title>
</head>

<body>

  <!-- header -->
 <?php include(ROOT_PATH . "/app/includes/header.php");?>
  <!-- // header -->

  <div class="auth-content">
    <form action="register.php" method="post">
      <h3 class="form-title">Register</h3>
      
        <?php include(ROOT_PATH . "/app/controllers/formErrors.php");?>

      <div>
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" name="passwordConf" value="<?php echo $passwordConf;?>" class="text-input">
      </div>
      <div>
        <button type="submit" name="register-btn" class="btn">Register</button>
      </div>
      <p class="auth-nav">Or <a href="<?php echo BASE_URL . '/login.php' ?>">Sign In</a></p>
    </form>
  </div>

  

</body>

</html>