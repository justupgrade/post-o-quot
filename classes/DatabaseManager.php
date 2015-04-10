<?php
	

	class DatabaseManager {
		static private $instance = null;
		private $connection;

		private function __construct() {
			$host = "localhost";
			$db_user = "justupgrade";
			$db_pass = "test";
			$db = "twitter_clone";

			$conn = new mysqli($host, $db_user, $db_pass, $db);
			if($conn->connect_error) echo "Connection error: " . $conn->connect_error;
			$this->connection = $conn;
		}

		public function createAccount($username,$email,$password) {
			$query = "INSERT INTO users (username, email,password) VALUES (";
			$query .= "'".$username."',";
			$query .= "'" . $email . "',";
			$query .= "'" . $this->getHashedPassword($password) . "')";

			if(!$this->connection->query($query)) return -1;
			else {
				return $this->connection->insert_id;
			}

			return -1;
		}

		private function getHashedPassword($password) {
			$options = array(
				'cost' => 5,
				'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
			);

			return password_hash($password, PASSWORD_BCRYPT, $options);
		}
		
		public function isUnique($login,$column) {
			$query = "SELECT * FROM users WHERE ".$column."='" . $login ."'";
			$result = $this->connection->query($query);

			if(!$result) return false;
			else {
				if($result->num_rows == 0) return true;
				else return false;
			}

			return false;
		}

		static public function getInstance() {
			if(!self::$instance) {
				self::$instance = new DatabaseManager();
			}

			return self::$instance;
		}
	}
?>