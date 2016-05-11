<?php
include 'html/header.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$data = $_POST;
		$profile = new Profile();
		$profile->setTable('users');
	//	var_dump();

		$validate = new Validate();
		$validate->setData($data);
		$validate->checkEmail('email');
		$validate->checkLength('password', 5, 1000);
		$validate->checkLogin($profile->login($data['password'], $data['email']));
		if(empty($validate->getMissing() )  and empty($validate->getErrors() ) )
        {
        	$id = $profile->login($data['password'], $data['email']);
        	$user_data = $profile->setUserId($id);
        	Session::set('user_id',$user_data['id']);
        	Session::set('username',$user_data['username']);
        	header('Location: /home');
        }else
        {
            foreach ($validate->getErrors() as $error)
            {
                printf('<p class="error"> %s </p>', $error);
            }
        }    	
	}
?>
	<style>
		body{
			font-family: 'Roboto Light', sans-serif;
		}
		form{
			width: 400px; 
			height: 270px;
			margin: 0 auto 0 auto;
			padding:20px;
			background:#eceef1;
		}
		#logo_holder{
			text-align: center;
			margin:4% 0 4% 0;

		}
		form h1{
			text-align: center;
			color:#79BCB4;
			margin-top: 0;
			margin-bottom: 13%;
		}
		.form-control{
			border-radius: 0;
			background: #DDE3EC;
			margin-bottom:3%;
			border: 0;

		}
		.btn-primary{
			background: #45B6AF;
			border-radius: 0;
			border: 0;
			font-weight: bold;
			padding:10px;
	                width: 86px;
			height: 40px;
			margin-top:2%;
		}
		.btn-primary:hover{
			background: #45B6AF;
		}
@media screen and (max-width: 500px){
	form{
		width:100%;
}
}
	</style>


		<form action="" method="post" role="form" id="search_form">
			<h1>Sign In</h1>
			<div class="form-group">
				<input type="text" name="email" class="form-control" placeholder="Username" value="stefany.dyulgerova@gmail.com">
				<input type="password" name="password" class="form-control" placeholder="Password" value="password1">
				<input type="submit" value="LOGIN"  class="btn btn-primary">
			</div>
		</form>
