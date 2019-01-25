# PHP-Advanced-Login-Script

Password protect web pages by adding one line of PHP code to the page source. Script will show login form to protect content from unauthorized access. Includes login form, signup form, password reminder, and user management page for admin. Uses flat file database, no MySQL required. Can be set up to redirect after successful login.

Installation:

    Update settings.php to match your needs (admin password, login form, signup form, and reminder form settings)
    Upload password protector (all the files from the package) to your server
    Set write permissions on users.php (users list file)
    Open User Manager manager.php in your favorite browser (it will prompt for admin password from settings.php). You'll see:
        Logout link
        Protection string to be added at the top of each page you want to protect
        List of users (Username, Password, Email, Redirect URL)

How to protect a webpage:

    Add protection string (available on User Management page) to each php page you would like to protect, at the very beginning of the page source (it must be the first line).
    For example you want to protect page members-only.php.
        open source code of the members-only.php in your favorite editor
        add the protection string (see above on how to get the protection string) at the beginning

How to link to login form:
You can add a link to login form from on any of your pages.
If you saved password protector in "protect" folder on your server, sample html code for link would be:
  <a href="http://www.example.com/protect/login.php">Login</a>

How to link to signup form:
You can add a link to signup form from on any of your pages.
If you saved password protector in "protect" folder on your server, sample html code for link would be:
  <a href="http://www.example.com/protect/signup.php">Signup</a>

How to link to password reminder form:
You can add a link to password reminder form from on any of your pages.
If you saved password protector in "protect" folder on your server, sample html code for link would be:
  <a href="http://www.example.com/protect/reminder.php">Password Reminder</a>

Note: login form, signup form, and password reminder form have its own header and footer templates. Find more information about password protector advanced on the forum. 
