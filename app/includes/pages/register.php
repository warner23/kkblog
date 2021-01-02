  <div class="auth-content">
    <form class="form-horizontal register-form">
       <fieldset>
      <h3 class="form-title">Register</h3>

       <div>
        <div class="control-group  form-group">
        <label>Username
        <span class="required">*</span></label>
        <div class="controls col-lg-8">
        <input type="text" name="username" value="" id="username" class="text-input">
      </div>
    </div>
  </div>
      <div>
        <div class="control-group  form-group">
        <label>Email
        <span class="required">*</span></label>
        <div class="controls col-lg-8">
        <input type="email" name="email" value="" id="email" class="text-input">
      </div>
      </div>
  </div>
      <div>
        <div class="control-group  form-group">
        <label>Password
        <span class="required">*</span></label>
        <div class="controls col-lg-8">
        <input type="password" name="password" value="" id="password" class="text-input">
      </div>
      </div>
  </div>

      <div>
        <div class="control-group  form-group">
        <label>Confirm Password
        <span class="required">*</span></label>
        <div class="controls col-lg-8">
        <input type="password" name="passwordConf" value="" id="passwordConf" class="text-input">
      </div>
      </div>
  </div>
      <div>
        <div class="control-group  form-group">
        <button type="submit" name="register-btn" id="register-btn"  class="btn">Register</button>
      </div>
      <p class="auth-nav">Or <a href="<?php echo BASE_URL ?> /login.php">Sign In</a></p>
    </div>
    <div id="result"></div>
  </fieldset>
    </form>
  </div>

<script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/sha512.js"></script>
 <script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/core.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>/resources/js/register.js"></script>