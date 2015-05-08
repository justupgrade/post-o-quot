<?php
	require_once "classes/DatabaseManager.php";
	$currentUserId = $user->getID();
	$currentUserName = $user->getPreferedName();

	if($currentUser != null) {
		$currentUserId = $currentUser->getID();
		$currentUserName = $currentUser->getPreferedName();
	}
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['title']) && isset($_POST['content'])) {
			$title = $_POST['title'];
			$content = $_POST['content'];
			
			$feedback = DatabaseManager::getInstance()->addPost($user, $title, $content);
		}
	}
?>

<div id='content'>
	<section id='posts-cont'>
		<article id='user-posts' class='default-style'>
<?php
	if(isset($feedback)) echo $feedback;
	if($user === $currentUser)
	{
?>
		<fieldset>
			<legend>Add Post</legend>
			<form action='' method='post'>
				<pre><p><label>Title:</label>	<input type='text' name='title' required></p></pre>
				<pre><label>Content:</label><textarea name='content' cols='100' rows='5'></textarea></pre>
				<input class='send-msg' type='submit' value='Send'>
			</form>
		</fieldset>
<?php
	}
?>
			<form method='post' action='./user.php'>
				<input type='submit' class='post-creator input-label special-chars' value='<?php echo  $currentUserName; ?>'>
				<input type='hidden' name='hiddenInputUserId' value='<?php echo $currentUserId; ?>'>
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


		