  <div class="auth-content">
    <form class="form-horizontal">
      <h3 class="form-title">Register</h3>

       <div>
        <label>Username</label>
        <input type="text" name="username" value="" class="text-input">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" value="" class="text-input">
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" name="passwordConf" value="" class="text-input">
      </div>
      <div>
        <button type="submit" name="register-btn" id="register-btn"  class="btn">Register</button>
      </div>
      <p class="auth-nav">Or <a href="<?php echo BASE_URL ?> /login.php">Sign In</a></p>
    </form>
  </div>

<script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/sha512.js"></script>
 <script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/core.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/register.js"></script>