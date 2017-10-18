<?php 
	session_start();
	if (!isset($_SESSION['email'])) {
		header("Location: form.php");
	}
?>
<?php if (isset($_SESSION['email'])):?>
	<h1><?php echo "Hello " . $_SESSION['email']; ?></h1>
	<br><br>
	<a href="logout.php">Dilni</a>
<?php endif; ?>