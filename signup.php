<?php

####################################################################
# Password Protect Avanced :: Signup Form - v.1.1
####################################################################
# Visit http://www.zubrag.com/scripts/ for documentation and updates
####################################################################

// load settings
include_once('settings.php');


class zubrag_signup_form {

  function zubrag_signup_form() {

    $this->error = '';
    $this->login = '';
    $this->email = '';

    if (USE_EMAIL && !USE_USERNAME)
      die('"USE_USERNAME" must be set to "true" when "USE_EMAIL" is set to "true"');
  }

  function parse_user_input() {
    $this->login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
    $this->pass = $_POST['access_password'];
    $this->email = LOGIN_AS_EMAIL 
                 ? $this->login 
                 : (isset($_POST['access_email']) ? $_POST['access_email'] : '');
    // remove suspicious characters
    $remove_chars = array("\n","\r", "\r\n", '"', "'", '&','<','>',',','/', '\\');
    $this->login = str_replace($remove_chars, '', $this->login);
    $this->pass = str_replace($remove_chars, '', $this->pass);
    // convert to lowercase
    $this->email = strtolower(str_replace($remove_chars, '', $this->email));
  }

  function showSignupPasswordProtect() { 
    include('signup_header.php');
    include('signup_form.php');
    include('signup_footer.php');
  }

  function validate_user_input() {
    // login validation
    if ($this->login === '') {
      $this->error = "Please enter login.";
      return false;
    }
  
    // password validation
    if ($this->pass === '') {
      $this->error = "Please enter password.";
      return false;
    }
    if ($this->pass == $this->login) {
      $this->error = "Password should not match login.";
      return false;
    }
  
    // email validation
    if (USE_EMAIL && preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/', $this->email) == 0) {
      $this->error = "Invalid email.";
      return false;
    }
  }

  function load_users_list() {
    // list of users
    $users = @file(USERS_LIST_FILE);
    if ($users) {
      // remove php "die" statement (hackers protection)
      unset($users[0]);
    }
  
    // prepare users list
    $this->LOGIN_INFORMATION = array();
    foreach ($users as $user) {
      $u = explode(',',$user);
      $this->LOGIN_INFORMATION[trim($u[0])] = trim($u[1]);
    }
  }

  function validate_user() {
    // check if user exists
    foreach($this->LOGIN_INFORMATION as $key => $value) {
      if ($key == $this->login) {
        $this->error = "Username $key already taken.";
        return false;
      }
    }
  }

  function save_user() {
    // save user to database
    $fusers = fopen(USERS_LIST_FILE,'a+');
    if (!$fusers) {
      $this->error = "Cannot add user to database.";
      return false;
    }
    fputs($fusers, "\n" . $this->login. ',' . $this->pass . ',' . $this->email);
    fclose($fusers);
  }

  function redirect() {
    header('Location: ' . SIGNUP_THANKS_URL);
    exit();
  }

}


$signup_form_instance = new zubrag_signup_form();

if (isset($_POST['access_password'])) {

  while (true) {
    $signup_form_instance->parse_user_input();
    if ($signup_form_instance->error) break;

    $signup_form_instance->validate_user_input();
    if ($signup_form_instance->error) break;

    $signup_form_instance->load_users_list();
    if ($signup_form_instance->error) break;

    $signup_form_instance->validate_user();
    if ($signup_form_instance->error) break;

    $signup_form_instance->save_user();
    if ($signup_form_instance->error) break;

    $signup_form_instance->redirect();

    break;
  }

  if ($signup_form_instance->error) $signup_form_instance->showSignupPasswordProtect();

}
else {

  // show signup form
  $signup_form_instance->showSignupPasswordProtect();

}

?>
