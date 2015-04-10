
		<article id='friend-posts' class='default-style'> 
<?php
	require_once './classes/User.php';
	require_once './includes/connection.php';
	require_once './includes/functions.php';

	$query = "SELECT friend_id,email,username FROM friends JOIN users ON friends.friend_id=users.id WHERE user_id=".$currentUserId;
	$result = $conn->query($query);

	if(!$result) echo "Error : " . $conn->error();
	else
	{
		$rows = $result->num_rows;
		if($rows > 0) {
			for($i = 0; $i < $rows; $i++) {
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$fID = $row['friend_id'];
				$fEmail = $row['email'];

				$posts = getPosts($conn,$fID);

				if(!$posts) echo "Error!";
				else {
					if($posts->num_rows>0) {
						echo "<form method='post' action='./user.php'>";
						echo "<input type='submit' class='post-creator input-label special-chars' value='" . $fEmail . "'></input>";
						echo "<input type='hidden' name='hiddenInputUserId' value='".$fID."'>";
						echo "</form>";

						while($post = $posts->fetch_array(MYSQLI_ASSOC)) {
							echo displayPost($post['title'], $post['content']);
						}
					}
				}
			}
		}
	}
?>

		</article>
	</section> <!-- END OF POSTS SECTION (user-posts + friend-posts) -->