<?php
     include 'html/header.php'; 

try 
{
    $posts = new Posts();
    $posts->setTable("posts");
    $posts->setPostId( Validate::isNumericString('topic_id', 'get') );
    extract( $posts->getTopic("id") );

    $comments = new Comments();
    $comments->setTable('reactions');
    $comments->setPostId($id);

    $profile = new Profile();
    $profile->setTable('users');
    $profile->setUserId($author_id);
    extract($profile->getUserInfo());
    $data = array('comment' => $_POST['comment'], 'user_id' => 1, 'topic_id' => $posts->getPostId(), 'date_posted' => time());

    $validate = new Validate('lol', 'post');
    $validate->setData($data);
    $validate->setRequired( array('comment') );
    $validate->checkMissing( array('url') );
    $validate->checkLength( 'comment', 5, 10 );

    $customDateTime = new CustomDateTime();
    $customDateTime->setTimestamp($date);
    echo $date;
    print_r( $validate->getMissing() );
    foreach ($validate->getErrors() as $error)
     {
        printf('<p class="error"> %s </p>', $error);
    }
    if(empty($validate->getMissing() )  and empty($validate->getErrors() ) )
    {
        print_r($data);
        $comments->insertComment($data, count($data));
    }

}catch(Exception $e)
{
    printf("%s  %s", $e->getMessage(), $e->getFile());
}

echo Session::get('lol');
    
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
               <time><?php print $customDateTime->getDate(true); ?></time>
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
             Start the foreach loop to display all comments related to the article.
             The function display_comments is in functions.php document.
             The function returns an array that holds absolutely all comments for that article.
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
                         ?>
                        <h5><?php echo date('d F Y',$comment['date_posted']); ?></h5>
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
        <!--        <input type="hidden" name="post_id" value="<?php //print $this_fuking_post; ?>" /> -->
            <label for="" class="secret"> Do not populate this field<input type="text" name="url" /></label>
        </fieldset>
        <!-- End of comment form -->
    </form>
<?php include 'html/footer.php'; ?>