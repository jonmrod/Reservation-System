<?php include('header.php'); ?>
<!DOCTYPE html>
<title>Registration</title>

<!-- Registration Page -->
<html>

<body>
  <meta charset = "utf-8">
  <title>Login Page</title>
  <form action="register.php" method="post">
    <h3>Create an account</h3>

    <!--input fields-->
    <p>
      <label>First Name: *</label> <input type="text" name="fname" value="">
      <br>
      <label>Last Name: *</label> <input type="text" name="lname" value="">
      <br>
      <label>Email: *</label> <input type="email" name="email" value="">
      <br>
      <label>Password: *</label> <input type="password" name="pass" value="">
      <br>
      <label>Re-enter Password: *</label> <input type="password" name="pass2" value="">
      <br>
    </p>
    <br>
    <h3>Make sure all fields are complete.</h3>
      <input type="submit" value="Submit">
    </form>

    <FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
    <?
    // Print any error messages, if they exist:
    if (isset($errors1) && !empty($errors1)) {
      echo '<h2><font color="red">Error!</h2></font>
      <p class="error">The following error(s) occurred:<br />';
      foreach ($errors1 as $msg) {
        echo " - $msg<br />\n";
      }
      echo '</p><p>Please try again.</p>';
    }
    ?>
  </body>
  <?php include('footer.php'); ?>
  </html>
