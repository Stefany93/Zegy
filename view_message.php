<?php  include 'html/header.php';
$message_id = (int)$_GET['message_id'];
$messages = read_messages($db, $message_id);
extract($messages[0]);
//print_r($messages);
?>
<div id="pm"> <?php
print '<h2>'.$messages_subject.'</h2>';
print '<p>'.$messages_content	.'</p>';
?>
</div>
<?php
//print_r($messages[0]);
//print $messages_sender_id;
$receiver_id = $messages_sender_id;
?>
<?php  
		if(isset($_POST['submit'])){ 
			send_pm($_POST['subject'], $_POST['message'], $receiver_id, $db);
	}
?>

<h2>Изпрати отговор на <a href=profile.php?id=<?php print $users_id?>><?php print $users_username; ?></a></h2>
<form id="pm" action="" method="post">
	<label>Тема: <input type="text" name="subject"></label>
	<label for="pm_body">Съобщение: </label>
	<input type="hidden" value="5" name="receiver_id" />
	<textarea rows="10" cols="40" id="pm_body" name="message"></textarea>
	<input type="submit" value="Изпращане" name="submit" />
</form>







<?php include 'html/footer.php'; ?>