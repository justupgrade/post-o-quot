<?php
	class Message {
		static private $connection;
		public $id;
		public $sender;
		public $receiver;
		private $title;
		private $message;
		public $receiver_id;
		public $sender_id;
		
		public function __construct($sender, $receiver, $title, $content, $id) {
			$this->id = $id;
			$this->sender = $sender;
			$this->receiver = $receiver;
			$this->title = $title;
			$this->message = $content;
		}
		
		static public function SetUpConnection($conn){
			self::$connection = $conn;
		}
		
		static public function sendMessage($sender,$receiver,$title,$content) {
			$query = "INSERT INTO messages (sender_id, receiver_id, title, content) VALUES (";
			$query .= $sender->getID() . "," . $receiver->getID() . ",";
			$query .= "'" . $title . "',";
			$query .= "'" . $content . "')";
			
			$result = self::$connection->query($query);
			
			if(!$result) {
				return "Erorr: " . self::$connection->error;
			} else {
				return "Message sent!";
			}
		}
		
		static public function GetAllMessagesSent($user) {
			$query = "SELECT messages.title as title, messages.id as messageID, messages.is_new as is_new, users.email as sender, receivers.email as receiver, messages.content as message ";
			$query .= "FROM messages JOIN users ON messages.sender_id=users.id ";
			$query .= " JOIN users as receivers ON receiver_id=receivers.id WHERE ";
			$query .= " messages.sender_id=" . $user->getID();
			
			$result = self::$connection->query($query);
			if(!$result) return "Error " . self::$connection->error;
			
			$messages = array();
			$idx = 0;
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$message = new Message($row['sender'], $row['receiver'], $row['title'], $row['message'], $row['messageID']);
				$messages[] = $message;
			}
			
			if(count($messages)>0) $_SESSION['msgs'] = $messages;
			
			return $messages;
		}
		
		static public function GetAllMessages($user) {
			$query = "SELECT messages.title as title, messages.id as messageID, messages.is_new as is_new, users.email as sender, receivers.email as receiver, messages.content as message ";
			$query .= "FROM messages JOIN users ON messages.sender_id=users.id ";
			$query .= " JOIN users as receivers ON receiver_id=receivers.id WHERE ";
			$query .= " messages.receiver_id=" . $user->getID();
			$query .= " ORDER BY is_new DESC";
			
			$result = self::$connection->query($query);
			if(!$result) return "Error " . self::$connection->error;
			
			$messages = array();
			
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$message = new Message($row['sender'], $row['receiver'], $row['title'], $row['message'], $row['messageID']);
				$messages[] = $message;
				
			}
			if(count($messages)>0) $_SESSION['msgs'] = $messages;
			
			return $messages;
		}
		
		public function getTitle(){
			if($this->title !== null && $this->title != "") return $this->title;
			
			return substr($this->message, 0, 20) . "...";
		}
	}
	
	/*
	 * $msg = $row['message'];
				if(strlen($msg) > 20 ) $msg = substr($msg, 0, 20) . "...";
				$is_new = $row['is_new'];
				echo "<form action='message.php' method='post' class='inbox-msg'>";
				if($is_new == true) {
					echo "<input type='submit' class='inbox-msg-input' value='" . $msg . "'>";
				} else {
					echo "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
				}
				echo "<input type='hidden' name='id' value='".$idx ."'>";
				echo "<input type='hidden' name='receiver' value='true'>";
				echo "</form>";
				$idx++;
	 */
	
	
	/*
	 * $msg = $row['message'];
	 if(strlen($msg) > 20 ) $msg = substr($msg, 0, 20) . "...";
	 $is_new = $row['is_new'];
	 if($is_new == true) {
	 $out .= "<form action='message.php' method='post' class='inbox-msg'>";
	 $out .= "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
	 $out .= "<input type='hidden' name='id' value='".$idx ."'>";
	 } else {
	 $out .= "<form action='message.php' method='post' class='inbox-msg'>";
	 $out .= "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
	 $out .= "<input type='hidden' name='id' value='".$idx ."'>";
	 }
	 $out .= "<input type='hidden' name='receiver' value='false'>";
	 $out .= "</form>";
	 $idx++;
	 */
?>