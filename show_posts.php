<?php 
include 'html/header.php';
$posts = new Posts();
$posts->setTable('reactions');
$posts->setAuthorId(Validate::isNumericString('id', 'get'))
?>
<article>
  <ul>
   <?php
       try
        { 
          foreach ($posts->getTopics( 'user_id' ) as $key => $value) 
          {
              printf("<li>%s</li>", Links::makeLink('show-posts', array($value['comment'], $value['id']), $value['comment']));
          }
        }catch(Exception $e){
          echo $e->getMessage();
        }
   ?>
 </ul>
</article>

 
<?php include 'html/footer.php'; ?> 