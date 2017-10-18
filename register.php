<?php 
	include 'includes.php';
	$user_object = new User;

	$email = stripslashes(htmlspecialchars($_POST['email']));
	$password = stripslashes(htmlspecialchars($_POST['password']));
	$repeatPassword = stripslashes(htmlspecialchars($_POST['repeatPassword']));

	if (strlen($email) == 0){
		echo "Please choose an email!";
	}else if (strlen($password) == 0){
		echo "You can't register without using a password!";
	}else if (strlen($repeatPassword) == 0){
		echo "Repeat the password please!";
	}else if (strcmp($password, $repeatPassword) != 0) {
		echo "Password mismatch";
	}else{
		if (!$user_object->checkExistingUser($email)) {
			echo $user_object->insertNewUser($email, password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]));
			$user_object->sendActivationEmail($email);
		}else{
			echo "This email is already in use";
		}
	}


?>