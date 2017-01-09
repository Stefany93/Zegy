<?php 
include 'html/header.php';
try
{
	// Posts

	$posts = new Posts();
	$posts->setTable('posts');
	// Get the category ID and sanitize it...
	$posts->setCategoryId( Validate::isNumericString( 'category_id', 'get') );
	$topics = $posts->getTopics();

	// Comments

	$comments = new Comments();
	$comments->setTable('reactions');

	// Profile
	$profile = new Profile();
	$profile->setTable('users');

}catch(PDOException $e)
{
	$handleExceptions->parseException($e);
}catch(Exception $e)
{
	$handleExceptions->parseException($e);
}
echo 'test';
echo $posts->test();
	// Check if there are any topics in the selected category
	if ($topics) 
	{
 ?>
		<div id="breadcrump"></div>
	<p> <?php echo Links::makeLink('new-topic', $posts->getCategoryId(), 'New Topic'); ?>  </p>
		<table id="first_page">
	
		<tr>
			<th>Topic</th>
			<th>Author</th>
			<th>Replies</th>
			<th>Last Post</th>
		</tr>
		
			<?php 
				foreach ($topics as $key => $value)
				 {
				$profile->setUserId($value['author_id']);
				$comments->setPostId($value['id'])
			
			?>
<tr>
			<td><?php echo Links::makeLink('topic', array($value['title'], $value['id']), $value['title'] ); ?></a></td>
			<td>
				<a href="profile.php?id=<?php echo $value['author_id']; ?>">
					<?php echo $profile->getUsername(); ?>
				</a>
			</td>
			<td><?php echo  $comments->countComments();  ?></td>
			<td><?php echo date('d F Y ',$value['last_post']); ?></td>
			</tr>
	<?php
	 	  }
		} 
	?>
		</table>

<?php include 'html/footer.php'; ?>