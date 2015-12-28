<?php
if(!isset($_SESSION))
{
  session_start();
}
require ('/Applications/MAMP/mysqli_connect.php');
?>
<html>
<body>
  <title>Review Reservation</title>

  <head>

    <?php
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

      <form id="form" method="post" action="reserved.php">

      </head>

      <h2><center>Confirm Reservation</h2>

        <?

        $room = $_POST['room'];
        $_SESSION['room'] = $room;

        ?>
        <div class="left2">

          <img src="./images/<? echo $room;?>.jpg" alt="Room 2" style="width:350px;height:250px;">

        </div>

        <div class="right2">
          <table align="left" border="0" style="width:400;">
            <tr>
              <td height="40">
                <div id="left">
                  <b>Your reservation:</b>
                </div>

                <div id="right">
                  <?
                  $SQL2 = "SELECT * FROM room WHERE room_id='$room'";
                  $r = @mysqli_query ($dbc, $SQL2);
                  $row = mysqli_fetch_assoc($r);
                  $occ = $row['max_occ'];
                  $roomName = $row['name'];
                  echo $roomName;
                  ?>

                </div>
                <br>

                <div id="left">
                  <b>Max Occupancy:</b>
                </div>
                <div id="right">

                  <?

                  echo $occ . " people";

                  ?>
                </div>
                <br>
                <div id="left">
                  <b>Check in date:</b>
                </div>
                <div id="right">
                  <?

                  $checkin_date = $_SESSION['checkdate'];
                  $date = strtotime($checkin_date);
                  $month = date("m", $date);
                  $monthName = date('F', mktime(0, 0, 0, $month, 10));
                  $daynYear = date (" d, Y", $date);
                  $dw = date( "l, ", $date);
                  echo $dw;
                  echo $monthName;
                  echo $daynYear;

                  ?>

                </div>

                <br>
                <div id="left">
                  <b>Check in time:</b>
                </div>
                <div id="right">
                  <?
                  $checkin_time = $_SESSION['checktime'];
                  $checkinTime = date('h:i A', strtotime($checkin_time));
                  echo $checkinTime
                  ?>
                </div>
                <br>
                <div id="left">
                  <b>Hours Reserved:</b>
                </div>
                <div id="right">
                  <?
                  $dw = date("g", strtotime($_SESSION['hours_reserved']));
                  echo $dw;
                  ?>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div id="left">
                  <b>Rate:</b><i> (per hour)</i>
                </div>
                <div id="right">
                  <?
                  $SQL2 = "SELECT rate FROM room WHERE room_id='$room'";
                  $r = @mysqli_query ($dbc, $SQL2);
                  $row = mysqli_fetch_assoc($r);
                  $rate = $row['rate'];
                  echo "$". $rate;
                  ?>
                </div>
                <br>
                <div id="left">
                  <b>Subtotal:</b>
                </div>
                <div id="right">
                  <?
                  $total = (int)$rate * (int)$dw;
                  echo $dw. " * " ."$" .$rate ." = <b>$". $total."</b>";
                  ?>
                </div>
                <br>
                <div id="right">
                  <i>(hours reserved * rate of room)</i>
                </div>
                <br>
                <br>
                <div id="left">
                  <b><u>Total:
                  </div>
                  <div id="right">
                    <?
                    echo "$".$total;
                    $_SESSION['total'] = $total;
                    ?>
                  </b>
                </u>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <h3>Please pick your payment type:</h3>
              <p>
                <div id="left">
                  <input type="radio" name="paymentType" value="Credit" checked> Credit
                  <input type="radio" name="paymentType" value="Debit"> Debit
                  <input type="radio" name="paymentType" value="Cash"> Cash
                </div>
                <br>
                <hr>
                <div id="left">
                  <input type="checkbox" name="accept" value="1" required>
                  You confirm all this information is correct.
                  <p>
                  </div>
                  <div id="left">
                    <i>Please click book to complete this booking</i>
                  </div>


                  <div id="right">
                    <p>
                      <input name="submit" type="submit" value="Book">
                    </form>
                    <script>
                    $("#form").Validate();
                    </script>
                  </div>

                  <div id="left">
                    <p>
                      <form action="reservation.php">
                        <input type="submit" value="Cancel">
                      </form>
                    </div>


                  </td>
                </tr>

              </table>
            </body>




            <?
          }
          ?>
          </html>
