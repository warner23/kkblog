  <div class="auth-content">
    <form class="form-horizontal">
      <h3 class="form-title">Login</h3>


      <div>
        <label>Username</label>
        <input type="text" name="username" id="username" value="" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" id="password" value="" class="text-input">
      </div>
      <div>
        <button type="submit" name="login-btn" class="btn" id="login-btn">Login</button>
      </div>
      <p class="auth-nav">Or <a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a></p>
    </form>
  </div>

  <script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/sha512.js"></script>
 <script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/core.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/login.js"></script>