<?php  include 'html/header.php';

try{
    $profile = new Profile();
    $profile->setTable('private_messages');
    $profile->setUserId(Session::get('user_id'));
    extract($profile->viewPM(Validate::isNumericString($_GET['message_id'] )));
    $profile->setTable('users');
    $profile->setUserId($sender_id);

}catch(Exception $e)
{
    $handleExceptions->parseException($e);
}catch(PDOException $e)
{
    $handleExceptions->parseException($e);
}
?>
<div id="pm"> <?php
print '<h2>subbect</h2>';
print '<p>'.$message	.'</p>';
?>
</div>
<?php  
		if(isset($_POST['submit'])){ 
            $profile->setTable('private_messages');
            $data = array('sender_id' => Session::get('user_id')
        , 'receiver_id' => $profile->getUserId(), 'message' => $_POST['message'], 'date_send' => time() );
			$profile->sendPrivateMessage($data, count($data));
	}
?>

<h2>Send a reply to: <a href=profile.php?id=<?php echo  $profile->getUserId(); ?>><?php print $profile->getUsername(); ?></a></h2>
<form id="pm" action="" method="post">
	<input type="hidden" value="5" name="receiver_id" />
	<textarea rows="10" cols="40" id="pm_body" name="message"></textarea>
	<input type="submit" value="Изпращане" name="submit" />
</form>







<?php include 'html/footer.php'; ?>