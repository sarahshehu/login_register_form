<?php 
	session_start();
	if (isset($_SESSION['email'])) {
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<div class="preloader">
		<img src="images/loading.gif" style="width: 40px; height: 40px;">
	</div>
	<center id="main">
		<h1>Welcome!</h1>
		<button id="login">Login</button>
		<button id="register">Register</button>
	</center>
	<div id="loginForm">
		<input type="text" placeholder="Email" id="loginEmail" required>
		<input type="password" placeholder="Password" id="loginPassword" required>
		<button id="loginBtn">Login</button>
		<p style="display: none; font-weight: bold; color: red;" id="loginErrorAlert"></p>
		<p id="registerRedirect">Click here to register</p>
	</div>

	<div id="registerForm">
		<input type="email" placeholder="Email" id="chosenEmail">
		<input type="password" placeholder="Choose Password" id="chosenPass">
		<input type="password" placeholder="Repeat Password" id="repeatPass">
		<button id="registerBtn">Register</button>
		<p style="display: none; font-weight: bold; color: red;" id="registerErrorAlert"></p>
		<p id="loginRedirect">Click here to login</p>
	</div>

</body>
</html>