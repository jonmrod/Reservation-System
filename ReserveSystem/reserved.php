<?php
if(!isset($_SESSION))
{
  session_start();

  require ('/Applications/MAMP/mysqli_connect.php');
}
?>
<form>
<html>
<title>Room Reserved</title>
<?php include('header.php');
if (!isset($_SESSION['user_id'])) {
  echo"<h1>You are not logged in!</h1>
  <p>Please login first.</p>";
  echo "<a href=loginreg.php>Login</a>";
}
else {
  $room = $_SESSION['room'];
  $total = $_SESSION['total'];
  $checkin_date = $_SESSION['checkdate'];
  $checkin_time = $_SESSION['checktime'];
  $paymentType = $_POST['paymentType'];
  $checkout_time = $_SESSION['checkout_time'];
  $hours_reserved = $_SESSION['hours_reserved'];
  $UserID = $_SESSION['user_id'];

  //insert reservation into database
  $SQL2 = "INSERT INTO `cps3351`.`reservation` (`reservation_id`, `checkin_date`, `checkin_time`, `checkout_time`, `totalhours`,`room_id`, `user_id`, `payment_id`, `status`)
  VALUES ('', '$checkin_date', '$checkin_time', '$checkout_time', '$hours_reserved','$room', '$UserID', '', 'Upcoming')";
  if (mysqli_query ($dbc, $SQL2)){
  } else{
    echo "ERROR: reservation Could not able to execute " . mysqli_error($dbc);


  }


  //get reservation id to use in payment information
  $q = "SELECT * FROM reservation WHERE checkin_date='$checkin_date' AND checkin_time='$checkin_time' AND checkout_time = '$checkout_time' AND room_id = '$room'";
  $r = @mysqli_query ($dbc, $q);
  $row = mysqli_fetch_array($r);
  $id = $row['reservation_id'];

  //insert room reservation
  $sql = "INSERT INTO `cps3351`.`room_reserve` (`reservation_id`, `room_id`)
  VALUES ('$id', '$room')";
  if (mysqli_query ($dbc, $sql)){
  } else{
    echo "ERROR: room reservation Could not able to execute " . mysqli_error($dbc);
  }

  //insert payment id
  $sql = "INSERT INTO `cps3351`.`payment` (`payment_id`, `amount`, `reservation_id`, `payment_type`)
  VALUES ('', '$total', '$id', '$paymentType')";
  if (mysqli_query ($dbc, $sql)){
  } else{
    echo "ERROR: payment Could not able to execute " . mysqli_error($dbc);
  }

  //select payment id from payment
  $q = "SELECT * FROM payment WHERE reservation_id='$id'";
  $r = @mysqli_query ($dbc, $q);
  $row = mysqli_fetch_array($r);
  $paymentID = $row['payment_id'];



  //update payment id in reservation table
  $sql = "UPDATE reservation SET payment_id='$paymentID', room_id='$room' WHERE reservation_id='$id'";
  if (mysqli_query ($dbc, $sql)){
  } else{
    echo "ERROR: payment Could not able to execute " . mysqli_error($dbc);
  }
}

?>

<center><h1>Reservation confirmed!</h1></center>
<center><h2>Your reservation ID is:
  <?
  echo "<u>" .$id.  "</u>";
  ?>
</h2>
</center>
<center><i>(Print this page for future reference)<i></center>
<p>
  <center><input type="button" value="Print this page" onClick="window.print()"></center>
  <p>

  <?

        $room = $_SESSION['room'];

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
                <br>
                <div id="left">
                  <b>Payment Type:</b>
                </div>
                <div id="right">
                <?
                  echo $paymentType;
                ?>
                </div>
              </td>
            </tr>
            <tr>
    </html>


</form>
