<?php
if(!isset($_SESSION))
{
  session_start();
}
?>
<html>
</style>
<body>
  <title>Reserve Room</title>

  <head>

    <?php include('header.php'); ?>
    <?php
    if (!isset($_SESSION['user_id'])) {
      echo"<h1>You are not logged in!</h1>
      <p>Please login first.</p>";
      Echo "<a href=loginreg.php>Login</a>";
    }
    else {
      ?>
    </head>
    <center><h1>Welcome <? echo $_SESSION['first_name']; ?>!</h1></center>


    <?php
    $id = $_SESSION['user_id'];
    $query="SELECT * FROM reservation WHERE `user_id` = $id and status= 'Upcoming' ORDER  BY checkin_date ASC";
    $results = mysqli_query($dbc, $query) or trigger_error(mysql_error().$query);


    $numOfRows = mysqli_num_rows($results);
    ?>
    <div id="content">
      <div class="right">
        <?
        if ($numOfRows == 0)
        {
          echo "<div class='right'><p><b>You have not made any reservations yet.</b><br>
          Any new reservations shall be posted here.</div>";
        }

        else
        {
          echo "<h2>Upcoming Reservations</h2>";

          ?>
          <table width="600" border="1">

            <tr>
              <td><b>Reservation ID</td>
              <td><b>Check In Date </td>
              <td><b>Check In Time </td>
              <td><b>Check Out Time </b></td>
              <td><b>Room Style</b></td>
              <td><b>Due at Check In</b></td>
              <?php
              while ($row = mysqli_fetch_array($results))
              {

                $date = strtotime($row['checkin_date']);
                      //check if date has passed
                if ($date > strtotime(date("Y-m-d")))
                {

                  $checkinTime = date('h:i A', strtotime($row['checkin_time']));
                  $checkout = date('h:i A', strtotime($row['checkout_time']));
                  $month = date("m", $date);
                  $monthName = date('F', mktime(0, 0, 0, $month, 10));
                  $daynYear = date (" d, Y", $date);
                  $dw = date( "l, ", $date);
                  $paymentID = $row['payment_id'];

                  echo "<tr>";
                  echo "<td>" .$row['reservation_id']. "</td>";
                  echo "<td>" .$dw . $monthName . $daynYear. "</td>";
                  echo "<td>" .$checkinTime. "</td>";
                  echo "<td>" .$checkout. "</td>";

                  $reserveID = $row['reservation_id'];

                  $sql = "SELECT * FROM room_reserve WHERE reservation_id='$reserveID'";
                  $r = @mysqli_query ($dbc, $sql);
                  $row = mysqli_fetch_assoc($r);
                  $room = $row['room_id'];

                  $sql = "SELECT * FROM room WHERE room_id='$room'";
                  $r = @mysqli_query ($dbc, $sql);
                  $row = mysqli_fetch_assoc($r);

                  $roomID = $row['room_id'];
                  $roomName = $row['name'];
                  ?>
                  <td>
                    <div class="hover_img">
                      <a href="#"><? echo $roomName;?><span><img src="images/<?echo $room;?>.jpg" alt="image" height="300" width="400" /></span></a>
                    </div>
                  </td>

                  <td>
                    <?
                    $sql = "SELECT * FROM payment WHERE payment_id='$paymentID'";
                    $r = @mysqli_query ($dbc, $sql);
                    $row = mysqli_fetch_assoc($r);

                    $total = $row['amount'];
                    $type = $row['payment_type'];
                    echo "<b>$". $total ."</b> (". $type .")";
                    ?>

                  </tr>
                  <?
                }
                else
                {

                }
              }
            }
            ?>
          </table>
        </div>


        <div class ="left">
          <form method="post" action="reserve.php">

            <table width="50" border="0" cellspacing="1" cellpadding="2">

              <h2>Check for Availability</h2>
              Check in date:
              <input type="date" name="date">

              <br>

              <tr>
                Check in time: <select name="time">
                <option value="9:00">9:00 am</option>
                <option value="10:00">10:00 am</option>
                <option value="11:00">11:00 am</option>
                <option value="12:00">12:00 pm</option>
                <option value="13:00">1:00 pm</option>
                <option value="14:00">2:00 pm</option>
                <option value="15:00">3:00 pm</option>
                <option value="16:00">4:00 pm</option>
                <option value="17:00">5:00 pm</option>
                <option value="18:00">6:00 pm</option>
                <option value="19:00">7:00 pm</option>
                <option value="20:00">8:00 pm</option>
                <option value="21:00">9:00 pm</option>
              </select>
            </tr>
          </select>
          <tr>
            <br>
            Hours Reserved:  <select name ="hours_reserved">
            <option value="1:00">1</option>
            <option value="2:00">2</option>
            <option value="3:00">3</option>
            <option value="4:00">4</option>
          </tr>
          <p>
            <input name="submit" type="submit" value="Check">


          </table>
          <p>
            <h3><i><a href="cancel.php">Cancel Reservation</a></i></h3>
            <?php

                      // Print any error messages, if they exist:
            if (isset($errors) && !empty($errors)) {
              echo '<h2><font color="red">Error!</h2></font>';
              foreach ($errors as $msg) {
                echo " - $msg<br />\n";
              }
              echo '</p><p>Please try another time or date.</p>';
            }
          }

          ?>
        </form>
      </div>
    </div>




  </body>
  <?php include('footer.php'); ?>
  </html>
