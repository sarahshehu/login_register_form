<?php 
	session_start();
	include 'includes.php';
	$user = new User;

	$email = stripslashes(htmlspecialchars($_GET['email']));
	$key = stripslashes(htmlspecialchars($_GET['activation_key']));

	if (!$user->checkActivation($email)){
		$user->activateUser($email);
		$_SESSION['email'] = $email;
		header("Location: index.php");
	}else{
		echo "Your account is already activated! Please go to the <a href='form.php'>log in</a> page to login!";
	}
?>