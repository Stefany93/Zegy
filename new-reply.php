<?php
     include 'html/header.php'; 
try 
{


    // Comments
    $comments = new Comments();
    $comments->setTable('reactions');
    $comments->setPostId( Validate::isNumericString('topic_id', 'get') );
    if(isset($_GET['quote']))
    {
        $comments->setCommentId(Validate::isNumericString('quote', 'get'));
    }
    //CustomDateTime
    $customDateTime = new CustomDateTime();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /*
            Construct the input array with $data
        */
        $data = array('comment' => $_POST['comment'], 'user_id' => Session::get('user_id'), 'topic_id' => $comments->getPostId(), 'date_posted' => time());
        /*
            Start Validation...
        */
        $validate = new Validate( 'post');
        $validate->setData($data);
        $validate->setRequired( array('comment') );
        $validate->checkMissing( array('url') );
        $validate->checkLength( 'comment', 10, 1000 );
        /*
            End validation...
        */
         $customDateTime->setTimestamp($date);

         // If there are no errors or input missing,
         // then insert the comment. Otherwise display the errors and the missing input.

        if(empty($validate->getMissing() )  and empty($validate->getErrors() ) )
        {
            $comments->insertComment($data, count($data));
        }else
        {
            foreach ($validate->getErrors() as $error)
            {
                printf('<p class="error"> %s </p>', $error);
            }
        }
    }

}catch(Exception $e)
{
   echo $handleExceptions->parseException($e);
}
    
?>
<section>
    <form action="" method="post">
       
        <label for="reply">Write your reply to the topic : <br>
            <textarea name="comment" id="reply" cols="30" rows="10" required ><?php echo trim(Session::rememberInput('comment')); ?>
                <?php   
                        if(isset($_GET['quote']))
                        {
                            echo trim($comments->getComment());
                        }
                 ?>
            </textarea>
        </label> 
        <input type="submit" />
    </form>
</section>
<?php include 'html/footer.php'; ?>