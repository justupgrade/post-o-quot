<?php
	$currentUserId = $user->getID();
	$currentUserName = $user->getPreferedName();

	if($currentUser != null) {
		$currentUserId = $currentUser->getID();
		$currentUserName = $currentUser->getPreferedName();
	}
?>

<div id='content'>
	<section id='posts-cont'>
		<article id='user-posts' class='default-style'>

			<form method='post' action='./user.php'>
				<input type='submit' class='post-creator input-label special-chars' value='<?php echo  $currentUserName; ?>'>
				<input type='hidden' name='hiddenInputUserId' value='<?php echo $user->getID(); ?>'>
			</form>

<?php
	require_once './includes/connection.php';
	require_once './includes/functions.php';


	$result = getPosts($conn,$currentUserId);

	if(!$result) {
		echo "Error: " . $conn->query($query);
	} else {
		if($result->num_rows>0) {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				echo displayPost($row['title'],$row['content']);
			}
		} else  {
			//no records...
		}
	}
?>

		</article>


		