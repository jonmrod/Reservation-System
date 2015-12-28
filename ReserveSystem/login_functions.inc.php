<?php
function redirect_user ($page = 'loginreg.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	// Add the page:
	$url .= '/' . $page;

	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

function check_login($dbc, $email = '', $pass = '') {

	$errors = array(); // Initialize error array.

	// Validate the email address:
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($email));
	}

	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($pass));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for the email/password combination:
		$q = "SELECT user_id, fname FROM users WHERE email='$e' AND pass=SHA1('$p')";
		$r = @mysqli_query ($dbc, $q); // Run the query.

		// Check the result:
		if (mysqli_num_rows($r) == 1) {

			// Fetch the record:
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

			// Return true and the record:
			return array(true, $row);

		} else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		}

	} // End of empty($errors) IF.

	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.
