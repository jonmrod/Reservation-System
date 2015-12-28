<?
if(!isset($_SESSION))
{
  session_start();
}

include('header.php');
if (!isset($_SESSION['user_id']))
{
  echo"<h1>You are not logged in!</h1>
  <p>Please login first.</p>";
  Echo "<a href=loginreg.php>Login</a>";
}
else {
  require_once('/Applications/MAMP/mysqli_connect.php');
  $id = $_SESSION['user_id'];
  ?>

  <title>Edit User</title>
  <html>
  <h1><center>Edit User</center></h1>
  <?

  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array();

    // Check for a first name:
    if (empty($_POST['fname'])) {
      $errors[] = 'You forgot to enter your first name.';
    } else {
      $fn = mysqli_real_escape_string($dbc, trim($_POST['fname']));
    }

    // Check for a last name:
    if (empty($_POST['lname'])) {
      $errors[] = 'You forgot to enter your last name.';
    } else {
      $ln = mysqli_real_escape_string($dbc, trim($_POST['lname']));
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
      $errors[] = 'You forgot to enter your email address.';
    } else {
      $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Check for an email address:
    if (empty($_POST['phone'])) {
      $errors[] = 'You forgot to enter your phone number.';
    } else {
      $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    }

    if (empty($errors)) { // If everything's OK.

      //  Test for unique email address:
    $q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id limit 1";
    $r = @mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) == 0) {

        // Make the query:
      $q = "UPDATE users SET fname='$fn', lname='$ln', email='$e', phone='$phone' WHERE user_id=$id";
      $r = @mysqli_query ($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

          // Print a message:
          echo '<p>The user has been edited.</p>';

        } else { // If it did not run OK.
          echo '<p class="error">Please change your user attributes.<p>';
        }

      } else { // Already registered.
        echo '<p class="error">The email address has already been registered.</p>';
      }

    } else { // Report the errors.

      echo '<p class="error">The following error(s) occurred:<br />';
      foreach ($errors as $msg) { // Print each error.
        echo " - $msg<br />\n";
      }
      echo '</p><p>Please try again.</p>';

    } // End of if (empty($errors)) IF.

  } // End of submit conditional.

  // Always show the form...

  // Retrieve the user's information:
  $q = "SELECT fname, lname, email FROM users WHERE user_id=$id";
  $r = @mysqli_query ($dbc, $q);

  if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_array ($r, MYSQLI_NUM);

    // Create the form:
    echo '<center><form action="settings.php" method="post">
    <p>First Name: <input type="text" name="fname" size="15" maxlength="15" value="' . $row[0] . '" /></p>
    <p>Last Name: <input type="text" name="lname" size="15" maxlength="30" value="' . $row[1] . '" /></p>
    <p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
    <input type="hidden" name="id" value="' . $id . '" />
    <p><input type="submit" name="submit" value="Submit" /></p>
  </form></center>';

  } else { // Not a valid user ID.
    echo '<p class="error">This page has been accessed in error.</p>';
  }

  mysqli_close($dbc);
}
include('footer.php');
?>


<html>
