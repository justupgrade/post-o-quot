<?php
	require_once './includes/connection.php';
	require_once './classes/User.php';

	$query = "SELECT * FROM users";

	if($user !== null) $query .= " WHERE id!=" . $user->getID();
	
	$result = $conn->query($query);

	if(!$result) {
		echo "Erorr: " . $conn->error;
	} else {
?>

<div id='content'>

<?php
		if($result->num_rows > 0) {
			echo "<section id='users-list-section'><article>";
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$user = new User($row['id'], $row['email'], $row['username']);
				echo addUserLabel($user->getPreferedName());
			}
			echo "</article></section>";
		}
	}

	function addUserLabel($username) {
		return "<div class='post-creator special-chars'>".$username."</div>";
	}
?>
		
	