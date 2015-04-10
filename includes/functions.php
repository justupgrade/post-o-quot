<?php
	function getPosts($conn, $userID) {
		$query = "SELECT id,title,content FROM posts ";
		$query .= "WHERE posts.user_id=" . $userID;
		$query .= " ORDER BY id DESC";

		return $conn->query($query);
	}

	function displayPost($title,$content) {
		$out = "<div class='post'>";
		$out .= "<div class='post-title'>" . $title ."</div>";
		$out .= "<div>" . $content ."</div>";
		$out .= "</div>";

		return $out;
	}

	function redirect($url='home.php') {
		header('Location: http://localhost/git/post-o-quot/' . $url);
		die();
	}
?>