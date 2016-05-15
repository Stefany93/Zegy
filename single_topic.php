<?php
     include 'html/header.php'; 
try 
{
    
    // Posts
    $posts = new Posts();
    $posts->setTable("posts");
    $posts->setPostId( Validate::isNumericString('topic_id', 'get') );
    extract( $posts->getTopic("id") );

    // Comments
    $comments = new Comments();
    $comments->setTable('reactions');
    $comments->setPostId($id);

    // Profile
    $profile = new Profile();
    $profile->setTable('users');
    $profile->setUserId($author_id);
    extract($profile->getUserInfo());

    //CustomDateTime
    $customDateTime = new CustomDateTime();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /*
            Construct the input array with $data
        */
        $data = array('comment' => $_POST['comment'], 'user_id' => Session::get('user_id'), 'topic_id' => $posts->getPostId(), 'date_posted' => time());
        /*
            Start Validation...
        */
        $validate = new Validate( 'post');
        $validate->setData($data);
        $validate->setRequired( array('comment') );
        $validate->checkMissing( array('url') );
        $validate->checkLength( 'comment', 5, 10 );
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


    <!-- Post data -->
    <script>
    window.onload = function()
    {
       // var height_of_topic = document.getElementById('general_topic').offsetHeight;
        //document.getElementById('poster_info').style.height = height_of_topic+'px';
    }   
    </script>
    <article id="general_topic">
        <h1 id="single_topic"><?php echo $title ?></h1>
       <?php  include 'partials/user_info.php'; ?>
           <!--  <hr></hr> -->
        <ul id="post_data">
            <li id="post_date">
               <time><?php print $customDateTime->getForumDate($date) ?></time>
            </li>
            <hr>
        </ul>
            <p>
                <?php echo nl2br($contents); ?>
            </p>
    <!-- End of post data -->
        </article>
<!-- Comment form -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

        <?php   
        /*
             Display commments
        */
           if( $comments->countComments() > 0 )
            {
                foreach($comments->getComments() as $comment)
                {
        ?>          
                    <div class="comment" id="comments_post_id<?php print $comment['id']; ?>">
                       <?php      
                            $profile->setUserId($comment['user_id']);
                            extract($profile->getUserInfo());                                                                                                          
                            include 'partials/user_info.php';
                            $customDateTime->setTimestamp($comment['date_posted']);
                         ?>
                        <h5><?php echo $customDateTime->getForumDate(); ?></h5>
                        <p>
                            <?php echo $comment['comment']; ?>
                        </p>
                        <ul id="options">
                            <li><a href="#">Report</a></li>
                            <li><a href="#">Quote</a></li>
                        </ul>
                    </div>
                    <hr>
        
        <?php       }
            }
        
         ?>
        <form method="post" action="" id="comment_form" >
        <fieldset>
            <label>
                What's your opinion...:<br /> 
            </label>
            <textarea rows="10" cols="50" id="text_comment"  name="comment"></textarea>
            <br>
            <input type="submit" name="commented" id="comments_button" value="Publish Comment" /> 
            <label for="" class="secret"> Do not populate this field<input type="text" name="url" /></label>
        </fieldset>
        <!-- End of comment form -->
    </form>
<?php include 'html/footer.php'; ?>