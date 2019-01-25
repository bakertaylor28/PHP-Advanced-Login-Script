    <form method="post">
      <h3>User signup</h3>
      <font color="red"><?php echo $this->error; ?></font><br />
      Login:<br /><input type='input' name='access_login' value='<?php echo $this->login ?>'/><br />Password:<br />
      <input type="password" name="access_password" />
  <?php if (USE_EMAIL && !LOGIN_AS_EMAIL) echo "<br />Email:<br /><input type='input' name='access_email' value='$this->email' />"; ?>
      <p></p>
      <input type="submit" name="access_submit" value="Sign up" />
    </form>
