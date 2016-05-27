<?php 
  include 'html/header.php';
  try{

    if(Session::get('sent') !== false)
    {
        echo '<p class="success"> PM sent! </p>';
        unset($_SESSION['sent']);
    }
    $profile = new Profile();
    $profile->setTable('users');
    $profile->setUserId(Validate::isNumericString($_GET['id'] ) );
    if(isset($_POST['message']))
    {
        $data = array('sender_id' => Session::get('user_id')
                      , 'receiver_id' => $profile->getUserId(), 'message' => $_POST['message'], 'date_send' => time() );
        $validate = new Validate( 'post');
        $validate->setData($data);
        $validate->setRequired( array('message') );
        $validate->checkMissing( array('url') );
        if(!$validate->presentErrors())
        {
          $profile->setTable('private_messages');
          $profile->sendPrivateMessage($data, count($data));
          Session::set('sent', '1');
          header('Location: http://dev.zegy/private-messages/'.$profile->getUserId());
        }else
        {
          echo $validate->returnErrorsOrMissing();
        }
    }
    }catch(Exception $e)
    {
      echo $handleExceptions->parseException($e);
    }catch(PDOException $e)
    {
      echo $handleExceptions->parseException($e);
    }
     $profile->setTable('users');
    $profile->setUserId(Validate::isNumericString($_GET['id'] ) );

?>
<article>
   <?php //if($_GET['send'] == 1) { ?>
        <form action="" method="post" style="margin:auto;width:313px">
            <h1>Send a Private message to <?php  echo $profile->getUsername(); ?></h1>
            <textarea name="message" id="" cols="30" rows="10"><?php Session::rememberInput('message'); ?></textarea>
            <input name="send_pm" type="submit" value="Send Private Message" />
        </form>






   <?php //} ?>

</article>

 
<?php include 'html/footer.php'; ?>