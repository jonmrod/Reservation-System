<?php
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('login_functions.inc.php');
	require ('/Applications/MAMP/mysqli_connect.php');

	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

	if ($check) { // OK!

		// Set the session data:
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['first_name'] = $data['fname'];

		// Redirect:
		redirect_user('reservation.php');

	} else { // Unsuccessful!

		// Assign $data to $errors logireg.php:
		$errors = $data;

	}

	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('loginreg.php');
?>
