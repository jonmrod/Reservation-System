<?
include('header.php');
if (!isset($_SESSION['user_id']))
{
  echo"<h1>You are not logged in!</h1>
  <p>Please login first.</p>";
  echo "<a href=loginreg.php>Login</a>";
}

else

{
  ?>
  <body>
    <form id="form" action="cancel_handle.php" method="post">
      <h1><center>Cancel Reservation</center></h1>

      <center>
      <label>Enter Reservation Number:</label> <input type="text" name="reserve_id" required>
        <p>
          <input type="checkbox" required>You agree to our terms and conditions.<br>
        <p>

          <input type="submit" value="Continue">
        </form>
        <script>
        $("#form").Validate();
        </script>
      </body>
      <?
      if (isset($errors) && !empty($errors))
      {
        echo '<h2><font color="red">Error!</h2></font>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg)
        {

          echo " - $msg<br />\n";

        }

        echo '</p><p>Please try again.</p>';
      }
    }
    ?>
    </center>
