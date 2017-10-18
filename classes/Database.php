<?php 

	class Database{
		private $conn;
		public function connect(){
			try {
				$conn = new PDO("mysql:host=localhost;dbname=form", "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				echo "Error ".$e->getMessage();
			}
			return $conn;
		}
	}
?>