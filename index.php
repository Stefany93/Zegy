<?php include 'html/header.php'; 

	try
	{
		$posts = new Posts;
		$posts->setTable('categories');
		$categories = $posts->getCategories();
		$posts->setTable('posts');		
	}catch(Exception $e)
	{
    	$handleExceptions->parseException($e);
	}catch(PDOException $e)
	{
		$handleExceptions->parseException($e);
	}
?>
	<table id="first_page">
		<tbody>
			<?php 
			/***
			* Look all the categories.
			*
			*/
				foreach ($categories as $key => $category) 
				{
					$posts->setCategoryId($category['categories_id']);
					printf('<tr><th> %s </th> <th class="num_topics"> Topics</th> </tr>'
							,Links::makeLink(
								 				$category['categories_id']
								 				,Links::cleanUrl($category['categories_name'])
								 				,$category['categories_name']
							   				)
						  );
					printf('<tr><td> %s </td> <td class="count"> %d </td></td></tr>',
									 $category['description'], $posts->countTopics());
				}
			?>
		</tbody>
	</table>

<?php include 'html/footer.php'; ?>