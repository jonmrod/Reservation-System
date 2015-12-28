<!DOCTYPE html>
<title>Main Page</title>
<style>
  h3{
    color: black;
  }
  h1{
    color: blue;
    border-bottom: 1px solid #000;
  }
  body {
    background-color: #D3D3D3;
    margin: 0;
  }
  p label{

    display: inline-block;
    width: 80px;

  }
  p input{
    width:150px;
  }
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  .right
  {
    padding-right:250px;
    float: right;
  }

  .left
  {
    padding-left:250px;
    float: left;
  }
</style>

<!-- Home page -->
<html>
<body>


  <head>

    <p style="white-space: pre;">

      <h1><center>Welcome to Reservation Services</center></h1>
      <center>
      </head>
      <div class="left">
        <table>
          <tr>
            <td> <h4>


              <div style="color:#0000FF"><i>
                Already registered? <p>
              </i>
            </div>
            Login with email and password<p>

            <form action="login.php" method="post">
              <p>

                <label for="email">Email:</label>
                <input type="email" name="email" value="">

                <br>

                <label for="password">Password:</label>
                <input type="password" name="pass" value="">
                <br>
              </p>
              <div align= "left">
                <input type="submit" value="Login">
              </div>
              <?php

                // Print any error messages, if they exist:
              if (isset($errors) && !empty($errors)) {
                echo '<h2><font color="red">Error!</h2></font>
                <p class="error">The following error(s) occurred:<br />';
                  foreach ($errors as $msg) {
                    echo " - $msg<br />\n";
                  }
                  echo '</p><p>Please try again.</p>';
                }

                  // Display the form:
                ?>
              </form>
            </div>
          </h4>
          <div align="center">
            <div style="color:#0000FF">
              <i>New user?</i>
              <form action="registration.php" method="post">
                <INPUT TYPE="submit" VALUE="Register">
                  <p>
                  </div>

                </form>

              </td>
            </tr>

          </table>
        </div>

        <div class="right">
          <table>
            <td>
            <!--
            output guidelines
            -->
              <h1>Reservation Guidelines</h1><p>
              <ul>
                <li><h4>Reservation must be reserved at least 1 or 2 days <p> prior to the event</h4></li>
                <li><h4>Maximum amount of hours allowed are 4 hours</h4></li>
                <li><h4>Cancellations must be made a least 7 days prior <p> A 20% penalty fee charge will be issued otherwise</h4></li>
                <li><h4>Payments will be due at the front desk of the facility<h4></li>
                <li><h4>Payments method accepted: Cash, Credit cards, Debit cards<h4></li>
                <li><h4>NO WEEKEND RESERVATION ALLOWED!<h4></li>

              </ul>
            </td>
          </table>
        </div>
      </body>
      <?php include('footer.php'); ?>
      </html>
