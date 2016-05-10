<?php
include 'html/header.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$post = $_POST;
	if(check_all_fields_empty($post)){
		user_login($post['username'], $post['password'], $db);
	}else{
		print '<h2 class="text-danger">Моля попълнете всички полета!</h2>';
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
				<input type="text" name="username" class="form-control" placeholder="Username" value="stefany">
				<input type="password" name="password" class="form-control" placeholder="Password" value="">
				<input type="submit" value="LOGIN"  class="btn btn-primary">
			</div>
		</form>
