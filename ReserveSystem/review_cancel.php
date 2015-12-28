<?
include('header.php');
?>
<form id="form" method="post" action="cancelled.php">
  <?
  $reserve_id = $_SESSION['reserve_id'];
  $q = "SELECT * FROM reservation WHERE reservation_id= '$reserve_id'";
  $r = mysqli_query($dbc, $q);
  $row = mysqli_fetch_array($r);
  $id = $row['room_id'];
  $checkdate = $row['checkin_date'];
  $checkinTime = $row['checkin_time'];
  $hours_reserved = $row['totalhours'];


  $imageName = "image_" .$id. ".php";
  ?>
  <center>
    <table style="width:50%">
      <?
      include($imageName);
      ?>
    </tr>
    <tr>

      <td height="40" colspan="2">
        <div id="left">
          <b>Your reservation:</b>
        </div>

        <div id="right">
          <?
          echo $reserve_id;
          ?>

        </div>

        <br>
        <div id="left">
          <b>Check in date:</b>
        </div>
        <div id="right">
          <?

          $date = strtotime($checkdate);
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
          $checkinTime = date('h:i A', strtotime($checkinTime));
          echo $checkinTime
          ?>
        </div>
        <br>
        <div id="left">
          <b>Hours Reserved:</b>
        </div>
        <div id="right">
          <?
          $dw = date("g", strtotime($hours_reserved));
          echo $dw;
          ?>
        </div>
        <br>
        <div id="left">
          <b>Total:</b>
        </div>
        <div id="right">
          <?
          $SQL2 = "SELECT amount FROM payment WHERE reservation_id='$reserve_id'";
          $r = @mysqli_query ($dbc, $SQL2);
          $row = mysqli_fetch_assoc($r);
          $total = $row['amount'];
          echo "<b>$".$total. "</b>";
          ?>
        </td>
      </tr>

    </table>
    <p>
      <?
      $newTotal = ((20/100) * $total);
      $_SESSION['newTotal'] = $newTotal;
      $penalty = $_SESSION['penalty'];
      if (is_numeric($penalty))
      {
        echo "<center><h2>You are cancelling this reservation within 7 days of the check in date.<br>
        You will be penalized <font color='red'>20%</font> of the total!</h2></center><p>";
        echo "<h2>NEW TOTAL: $" .$newTotal. "!</h2>";
      }
      ?>
      <input name="submit" type="submit" value="Submit">
    </form>
