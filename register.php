<?php include 'html/header.php'; 
try
{
  # When the user clicks submit
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
        $data = $_POST;
        $validate = new Validate('post');
        $validate->setData($data);
        $validate->setRequired( array('username', 'password', 'email', 'country') );
        $validate->checkMissing( array('url') );
        $validate->checkLength( 'username', 2, 15 );
        $validate->checkLength( 'password', 5, 100000);
        $validate->checkEmail( 'email' );

        if(empty($validate->getMissing() )  and empty($validate->getErrors() ) )
        {
          $profile = new Profile();
          $profile->setTable('users');
          $profile->register($data, count($data));
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
  $handleExceptions->parseException($e);
}
  ?>
  <div id="register_page">
  <h1>Register in  <em>Zegy</em></h1>
  <hr></hr>
  <form action="" method="post" id="register">
  		<label>Nickname <span>*</span>:
  		 	<input type="text" name="username" maxlength="30" id="username" required/>
  		</label>
  		<label for="">Country:<span>*</span><select name="" class="long_input" id="country">
  				<option value="Kenya">Kenya</option>
  			</select>
  		</label>
  		<label>Email: <span>*</span>:
  		 	<input type="text" name="email" maxlength="266" id="email" required/>
  		</label>
  		<label>Password <span>*</span>:
  		 	<input type="password" name="password"  class="long_input" id="password" required/>
  		</label>
  		 	<input type="submit" value="Register" id="button" />
  </form>
</div>
<?php include 'html/footer.php'; ?>