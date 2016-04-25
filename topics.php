<?php 
include 'html/header.php';
try
{
	$posts = new Posts();
	$posts->setTable('posts');
	$posts->setCategoryId( Validate::isNumericString( 'category_id', 'get') );
	$topics = $posts->getTopics();

	$comments = new Comments();
	$comments->setTable('reactions');

	$profile = new Profile();
	$profile->setTable('users');

}catch(PDOException $e)
{
	printf("%s", $e->getMessage());
}catch(Exception $e)
{
	printf("%s", $e->getMessage());
}
	if ($topics) 
	{
 ?>
		<div id="breadcrump"></div>

		<table id="first_page">
	
		<tr>
			<th>Topic</th>
			<th>Author</th>
			<th>Replies</th>
			<th>Last Post</th>
		</tr>
		
			<?php 
			foreach ($topics as $key => $value) {
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
	<?php }
	} ?>
		
		</table>

<?php include 'html/footer.php'; ?>