<?php 
include 'html/header.php';
    try
    {
        $profile = new Profile();
        $profile->setTable('users');
        $profile->setUserId( Validate::isNumericString('id', 'get') );
        extract($profile->getUserInfo());
    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }catch(Exception $e)
    {
        echo $e->getMessage();
    }
    echo $profile->getUserInfo()['id'];
    
?>
<article>
    <section id="user_info">
        <h1>Profile of <?php echo $profile->getUsername();?></h1>
            <img src="<?php  echo "images/avatars/$avatar";?>" width="140" height="130" /></li>
            <ul id="user_actions">
                <li><?php echo Links::makeLink('private-messages', $id, 'Send a private message'); ?> </li>
                <li><?php echo Links::makeLink('show-topics', $id, 'Show Topics'); ?> </li>
                <li> <?php echo Links::makeLink('show-posts', $id, 'Show Posts'); ?></li>
            </ul>
            <ul id="user_data">
                <li>Country: <?php echo $country; ?> </li>
                <li>Number of posts:  <?php //echo $profile->number_of_posts(); ?> </li>
                <li>Gender: </li>
                <li><strong> Contact information:  </strong></li>
                <li>Skype: </li>
                <li>Email: </li>
                <li>GoodReads: </li>
                <li>Personal Website:  </li>
            </ul>
    </section>
</article>

 
<?php include 'html/footer.php'; ?>