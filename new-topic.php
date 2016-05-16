<?php
     include 'html/header.php'; 
try 
{
     if($_SERVER['REQUEST_METHOD'] == 'POST')
     {
                        $posts = new Posts();
                $posts->setTable("posts");
                $posts->setCategoryId( Validate::isNumericString('category_id', 'get') );
        //     
         /*
             Construct the input array with $data
         */
            $data = array('title' => $_POST['title'], 'contents' => $_POST['contents']
                        , 'author_id' => Session::get('user_id'), 'category_id' => $posts->getCategoryId()
                        , 'date' => time() );    

          /*
             Start Validation...
         */
         $validate = new Validate( 'post');
         $validate->setData($data);
         $validate->setRequired( array('title', 'contents') );
         $validate->checkMissing( array('url') );
         $validate->checkLength( 'title', 5, 255 );
         $validate->checkLength( 'contents', 5, 1000 );
        
          //   End validation...
        
        //   If there are no errors or input missing,
        //   then insert the comment. Otherwise display the errors and the missing input.
         if(!$validate->presentErrors() )
         {
            $posts->insert($data, count($data));
         }else
         {
           echo $validate->returnErrorsOrMissing();
         }
     }

 }catch(Exception $e)
 {
    echo $handleExceptions->parseException($e);
 }

?>
<section>
    <form action="" method="post">
        <label for="title">
            Title: 
            <input type="text" name="title" id="title"  value="<?php echo Session::rememberInput('title')?>"  />
        </label>
        <label for="contents">Contents: <br>
            <textarea name="contents" id="contents" cols="30" rows="10" ><?php echo trim(Session::rememberInput('contents')); ?></textarea>
        </label> 
        <input type="submit" />
    </form>
</section>
<?php include 'html/footer.php'; ?>