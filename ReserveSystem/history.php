<?
include ('header.php');
$id = $_SESSION['user_id'];


//set past reservations to Finished
$q = "SELECT * FROM reservation WHERE `user_id` = $id AND status != 'Cancelled' AND checkin_date < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY checkin_date ASC";
$r = mysqli_query($dbc, $q);
while ($row = mysqli_fetch_array($r))
{
	$id = $row['reservation_id'];
	$q = "UPDATE reservation SET status = 'Finished' WHERE reservation_id= '$id'";
	mysqli_query($dbc, $q);
}

$query= "SELECT * FROM reservation WHERE `user_id` = $id AND status = 'Finished' OR status = 'Cancelled' OR checkin_date < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY checkin_date ASC";
$results = mysqli_query($dbc, $query) or trigger_error(mysql_error().$query);


$numOfRows = mysqli_num_rows($results);
?>
<center>
	<div id="content">
		<?
		if ($numOfRows == 0)
		{
			echo "<p><b>You have not made any reservations yet.</b><br>
			Any reservations shall be posted here.";
		}

		else
		{
			echo "<h1>Past Reservations</h1>";

			?>
			<table width="600" border="1">

				<tr>
					<td><b>Reservation ID</td>
						<td><b>Check In Date </td>
							<td><b>Check In Time </td>
								<td><b>Check Out Time </b></td>
								<td><b>Room Style</b></td>
								<td><b>Due at Check In</b></td>
								<td><b>Status</b></td>
								<?php
								while ($row = mysqli_fetch_array($results))
								{

									$date = strtotime($row['checkin_date']);


									$status = $row['status'];
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
									$row = mysqli_fetch_array($r);
									$room = $row['room_id'];

									$sql = "SELECT * FROM room WHERE room_id='$room'";
									$r = @mysqli_query ($dbc, $sql);
									$row = mysqli_fetch_assoc($r);

									$roomID = $row['room_id'];
									$roomName = $row['name'];
									?>
									<td>
										<div class="hover_img">
											<a href="#"><? echo $roomName;?><span><img src="images/<?echo $room;?>.jpg" alt="image" height="300" width="400"/></span></a>
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
									</td>
									<td>
										<?
										echo $status;
										?>
									</td>

								</tr>
								<?
							}
						}
						?>
					</table>
				</center>
				<?

				include ('footer.php');
				?>
