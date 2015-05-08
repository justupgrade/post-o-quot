<div id='content'>
	<section id='messages-box'>
		<article id='box-labels'> <!-- buttons: inbox,sent,saved,new -->
			<a href='?inbox'><div class='box-menu blue-blue-style'>Inbox</div></a>
			<a href='?sent'><div class='box-menu blue-blue-style'>Sent</div></a>
			<div class='box-menu blue-blue-style'>Saved</div>
			<a href='?new'><div class='box-menu blue-blue-style'>New</div></a>
		</article>

<!-- NEW MSG -->
<?php if (isset($feedback)) echo $feedback; ?>
		<article id='box-content' class='default-style'> <!-- content -->
<?php 
	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sent'])) {
		$messagesSent = Message::GetAllMessagesSent($user);
		
		foreach($messagesSent as $message) {
			echo "<div class='msg-cont'>";
			echo "<div class='message-label'>" . $message->getTitle() . "</div>";
			echo "<div class='chatter'>" . $message->receiver . "</div>";
			echo "</div>";
		}
	} elseif(isset($_GET['new']) || isset($_POST['sendMsgBtn'])) { ?>
		
<fieldset>
<form method='post' action=''> 
	<input type='text' name='receiver' id='receiverID' value='<?php echo $receiver_email; ?>'> <br>
	<input type='text' name='titleText' id='titleID' placeholder='title'> <br>
	<textarea cols='30' id='content_text' name='content'></textarea><br>
	<input class='send-msg' type='submit' value='send' id='submitBtn' name='sendMessage'>
</form>
</fieldset>
<?php	}
	else {
		$messages = Message::GetAllMessages($user);
		
		foreach($messages as $message) {
			echo "<div class='msg-cont'>";
			echo "<div class='message-label'>" . $message->getTitle() . "</div>";
			echo "<div class='chatter'>" . $message->sender . "</div>";
			echo "</div>";
		}
	}
?>
		</article>
	</section>