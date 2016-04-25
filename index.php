<?php include 'html/header.php'; 
	$posts = new Posts;
	$posts->setTable('categories');
	$categories = $posts->getCategories();
	$posts->setTable('posts');
?>
		
	
		<table id="first_page">
				<tbody>
					<?php 
				foreach ($categories as $key => $category) 
				{
					$posts->setCategoryId($category['categories_id']);
					printf('<tr><th> %s </th> <th class="num_topics"> Topics</th> </tr>',
							 Links::makeLink(
							 				$category['categories_id'],
							 				Links::cleanUrl($category['categories_name']),
							   				$category['categories_name']
							   				
							   			)
							);
					printf('<tr><td> %s </td> <td class="count"> %d </td></td></tr>', $category['description'], $posts->countTopics());
				}
			?>
		<!-- <tr>
			<th><?php// echo Links::makeLink('1', 'military-history', 'Military History');?></th>
			
		</tr>
		<tr>
			<td>Discuss battles, rate generals, prove how you 
									would have won a certain battle.</td>
			<td class="count">2</td>
		</tr>
				<tr>
			<th><a href="topics.php?category_id=2">Social History</a></th>
			<th class="num_topics"> Topics</th>
		</tr>
		<tr>
			<td>Marriages of the royalties/aristocrats, the best mistress of Henry VIII, how people lived in the past, 
					what they cooked, etc.</td>
			<td class="count">1</td>
		</tr>
				<tr>
			<th><a href="history-books">History Books</a></th>
			<th class="num_topics"> Topics</th>
		</tr>
		<tr>
			<td>Rate books, recommend/seek recommendation of history books, or write one.</td>
			<td class="count">1</td>
		</tr>
				<tr>
			<th><a href="off-topic">Off Topic</a></th>
			<th class="num_topics"> Topics</th>
		</tr>
		<tr>
			<td>Discussions about anything except history.</td>
			<td class="count">1</td>
		</tr> -->
		
			</tbody></table>

<?php include 'html/footer.php'; ?>