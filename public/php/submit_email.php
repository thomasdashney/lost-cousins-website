<?php
	// bring in db credentials from db config file
	include('db-config.php');

	$db = new mysqli($host, $username, $password, $database);

	if (!isset($_POST['email'])) {
		echo 'No email provided';
		return;
	}

	// Check connection
	if ($db->connect_error) {
	    die('Connection failed: ' . $db->connect_error);
	}

	// build/exec insert query
	$stmt = $db->prepare('INSERT INTO emails (email) VALUES (?)');
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$db->close();

	echo 'Success';
?>