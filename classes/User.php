<?php 
	class User extends Database{

		private $security_token;

		public function setSecurityToken($token){
			$this->security_token = $token;
		}
		public function getSecurityToken(){
			return $this->security_token;
		}
		public function queryBuilder($email, $password = null){
			$sql = 'select * from user';
			$where = [];
			$params = [];

			$where[] = 'email = ?';
			$params[] = $email;

			if ($password != null) {
				$where[] = 'password = ?';
				$params[] = $password;
			}

			$sql .= ' where ' . implode(' and ', $where);
			$stmt= $this->connect()->prepare($sql);
			$stmt->execute($params);
			$resultArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resultArray;
		}
		public function checkExistingUser($email, $pass = null){
			if (empty($this->queryBuilder($email))) {
				return false;
			}else{
				//if not empty lets check for password
				$result = $this->queryBuilder($email);
				if (password_verify($pass, $result[0]['password'])) {
					return true;					
				}
			}
		}
		function generateRandomString($length = 20) {
    		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
		}
		public function sendActivationEmail($email){
			$this->setSecurityToken($this->generateRandomString());
			$sql = "update user set activation_key = :genkey where email = :email";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(':genkey', $this->getSecurityToken());
			$stmt->bindParam(':email', $email);
			$stmt->execute();

			$to = $email;
	        $subject = "Account activation email"; 
	        $message = "<h1>Click in the link below to activate your account</h1>";     
	        $message .= "<a href='localhost/form/activation.php?email=".$email."&activation_key=".$this->getSecurityToken()."'>www.domain.com/form/activation.php?email=".$email."&activation_key=".$this->getSecurityToken()."</a>";
	        $header = "From:ndrukajshpresim@gmail.com \r\n";
	        $header .= "Cc:ndrukajshpresim@gmail.com \r\n";
	        $header .= "MIME-Version: 1.0\r\n";
	        $header .= "Content-type: text/html\r\n";        
	        mail ($to,$subject,$message,$header);
		}

		public function insertNewUser($email, $password){
			$sql = "insert into user(email, password) values (:email, :password)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);

			try{
				$stmt->execute();					
				return true;
			}catch(Exception $e){
				return false;
			}

		}

		public function checkActivation($email){
			$userFetchedData = [];
			$userFetchedData[] = $this->queryBuilder($email);
			foreach ($userFetchedData as $userRow) {
				if ($userRow[0]['activated'] == 1) {
					return true;
				}else{
					return false;
				}
			}
		}

		public function activateUser($email){
			$sql = "update user set activated = 1 where email = :email";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
		}

	}
?>