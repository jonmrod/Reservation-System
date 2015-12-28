<?php
include ('header.php');
echo '<center><h1>Registered Users</h1></center>';

require_once('/Applications/MAMP/mysqli_connect.php');

if ($role != 'Admin')
{
	echo"<h1>You are not authorized to see this page!</h1>
	<p>Please login as Administrator.</p>";
	echo "<a href=loginreg.php>Login</a>";
}
else
{

	// Determine where in the database to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start = $_GET['s'];
	} else {
		$start = 0;
	}

	// Define the query:
	$q = "SELECT lname, fname, email, role, user_id FROM users WHERE role != 'Admin'";
	$r = @mysqli_query ($dbc, $q); // Run the query.

	// Table header:
	echo '<table align="center" cellspacing="0" cellpadding="5" width="60%">
	<tr>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b>Last Name</a></b></td>
	<td align="left"><b>First Name</a></b></td>
	<td align="left"><b>Email</b></td>
	<td align="left"><b>User ID</b></td>
	<td align="left"><b>Role</b></td>
	</tr>
	';

	// Fetch and print all the records....
	$bg = '#eeeeee';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
		<td align="left">' . $row['lname'] . '</td>
		<td align="left">' . $row['fname'] . '</td>
		<td align="left">' . $row['email'] . '</td>
		<td align="left">' . $row['user_id'] . '</td>
		<td align="left">' . $row['role'] . '</td>
		</tr>
		';
	} // End of WHILE loop.

	echo '</table>';
	mysqli_free_result ($r);
	mysqli_close($dbc);
}

include ('footer.php');
?>
