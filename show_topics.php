<?php 
include 'html/header.php';
$posts = new Posts();
$posts->setTable('posts');
$posts->setAuthorId(Validate::isNumericString('id', 'get'))

//if(isset($_POST['message']))
//{
   // if($profile->sendPrivateMessage($_SESSION['session_user_id'], $profile->author_id, $_POST))
//    {
      //  echo '<p>Message sent to '.$profile->getUsername().'!</p>';
        
  //  }
//}
?>
<article>
  <ul>
   <?php
       try
        { 
          foreach ($posts->getTopics( 'author_id' ) as $key => $value) 
          {
              printf("<li>%s</li>", Links::makeLink('topic', array($value['title'], $value['id']), $value['title']));
          }
        }catch(Exception $e){
          echo $e->getMessage();
        }
   ?>
 </ul>
</article>

 
<?php include 'html/footer.php'; ?>