<?php
// Conecting to the database using mysql driver.
// We are enclosing our connection inside a try catch block
// in case the connection fails, it won't show our freaking 
// credentials!
		$db = new PDO('sqlite:db/vughs');
/*	
	}catch(Exception $e){
		echo 'Server currently down! Please come back later!';
	}
	
*/	