<?php
	session_start();
	include 'includes.php';
	$user = new User;

	$email = stripslashes(htmlspecialchars($_POST['email']));
	$password = stripslashes(htmlspecialchars($_POST['password']));

	$r = $user->checkExistingUser($email, $password);
	if ($r) {
		if ($user->checkActivation($email)) {
			$_SESSION['email'] = $email;
			echo "success";
		}else{
			echo "unactivated_account";
		}
	}else{
		echo "incorrect";
	}
?>