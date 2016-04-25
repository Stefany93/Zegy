<?php 
include 'html/header.php';
$profile = new Profile();
$profile->setTable('users');
$profile->setUserId(Validate::isNumericString($_SESSION['session_user_id']) );

//if(isset($_POST['message']))
//{
   // if($profile->sendPrivateMessage($_SESSION['session_user_id'], $profile->author_id, $_POST))
//    {
      //  echo '<p>Message sent to '.$profile->getUsername().'!</p>';
        
  //  }
//}
?>
<article>
   <?php if($_GET['send'] == 1) { ?>
        <form action="" method="post" style="margin:auto;width:313px">
            <h1>Send a Private message to <?php echo $profile->getUsername(); ?></h1>
            <textarea name="message" id="" cols="30" rows="10"></textarea>
            <input name="send_pm" type="submit" value="Send Private Message" />
        </form>






   <?php } ?>

</article>

 
<?php include 'html/footer.php'; ?>