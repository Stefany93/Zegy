<?php
/* Functions for the "secret" directory */
# Insert camera details into the DB
//include 'C:/xampp/htdocs/webcambgcom/config.php';


// Insert records into the database.
	function PDOinsert($table_name, $columns_array, $values_array, $db){
// Implode the columns so that at the end they will be separated
// with a comma as a list of columns like this - table1, table2, table3 and so on.
		$columns = implode(',', $columns_array);
// We do the same with the $values_array
		$values = implode(',',  $values_array);
// The placeholders of our query. We choose "?"
// because otherwise it will be impossible to
// mention each value by name like this - :value1, :value2, :value3.
		$value_placeholders = '?';
// We count the $values_array and depending the number
// of elements in the $values_array, we we append the $value_placeholders
// variable with "?" which will serve as placeholders in the query.
		for($i = 1; $i < count($values_array); $i++){
			$value_placeholders .=' , ?';
		}
// We construct the query.
	 	$sql = "INSERT INTO {$table_name}({$columns})
				VALUES($value_placeholders)";
// We prepare it.
	$query = $db->prepare($sql);
	$y = 0;
// We bind the parameters depending how 
// many elements there are in the $values_array.
	for ($x=1; $x <= count($values_array); $x++) { 		
		$query->bindParam($x,$values_array[$columns_array[$y]]);
		$y++;
	}
// We execute the query.
		if($query->execute() === true){
// We return the last inserted ID.
		return $db->lastInsertId();	
	}
// If the execution of the query fails, we print an error message
	else{
		print 'There was an error with inserting the records on the database! Please try again later';
	}

} // End of the function.



/* End of functions for the "secret" directory */
/* Functions for single_camera.php */
	function PDOselect($columns_array, $table_name, $condition, $value_for_condition
						, $db, $join = null, $second_table = null, $condition_to_join = null){
		if(is_array($columns_array)){
				$columns = implode(',', $columns_array);
		}else{
			$columns = $columns_array;
		}
		 	$sql = "SELECT {$columns} FROM  {$table_name}
		 			$join $second_table
		 			$condition_to_join
					WHERE {$condition} = {$value_for_condition}
					";
	//				print $sql;
	$query = $db->prepare($sql);
	//print count($columns_array);
	$query->execute();
	//$results = $query->fetch(PDO::FETCH_ASSOC);
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$results[] = $row;
		}
		return $results;
	}

function PDOupdate($table_name, $columns_string, $new_values, $condition, $value_for_condition, $db){

	//$columns_array = implode(',', $columns_string);
	//$values_array = implode(',', $new_values);
	$columns_array = $columns_string;

	$values_array = $new_values;
	//print_r($values_array);
	$columns_count = count($columns_array);
	$update_query = '';
	for ($i=0; $i < $columns_count ; $i++) { 
		//str_replace("'", '', $values_array[$i]);
	//		$values_array[$i] = htmlentities($values_array[$i], ENT_QUOTES);	
		$update_query .= "$columns_array[$i]=?";
		if($i != $columns_count - 1){
			$update_query .= ',';
		}
	}
	$sql = "UPDATE $table_name
			SET $update_query
			WHERE $condition = $value_for_condition";
			
	$query = $db->prepare($sql);
//	print_r($values_array);
	$i = 0;
	for ($x=1; $x <= $columns_count; $x++) { 		
		$query->bindParam($x,$values_array[$i]);
	//	print $x++;
	//	print $x;
	//	print $values_array[$x];
		$i++;
	}
	print $sql;
		
		$query->execute();

//	print $update_query;

}

function check_all_fields_empty($fields_array, $exceptions_array = array()){
	$number_of_fields = count($fields_array);
			foreach ($fields_array as $key => $value) {
				if(empty($value) and !in_array($key, $exceptions_array)){
					return false;
			}
		}
		return true;
}
