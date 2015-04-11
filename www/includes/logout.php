<?php
	session_start();
	session_destroy();

	header("Location: http://post-o-quot.com");
?>