<?php 
include 'html/header.php';
try{
$profile = new Profile();
$profile->setTable('private_messages');
$profile->setUserId(Validate::isNumericString(Session::get('user_id')));
?>
<article>
    <h1>Private Messages</h1>
    <table id="messages">
        <tr>
            <th>Sender </th>
            <th>Subject </th>
            <th>Date </th>
        </tr>
        <?php
    $messages = $profile->listPrivateMessages();
    $profile->setTable('users');

        foreach($messages as $message => $msg){
            $profile->setUserId($msg['sender_id']);

            //print '<a href="view_message.php?message_id='.$msg['messages_id'].'">'.$msg['messages_subject'].'</a>';
        
    ?>
        <tr>
             <td><a href=profile.php?id=<?php print $msg['sender_id']; ?> ><?php print $profile->getUsername(); ?></a></td>
            <td><a href=view_message.php?message_id=<?php print $msg['id']; ?>>Messsage from <?php echo $profile->getUsername();?></a></td>
            <td><?php print date('M d Y',$msg['date_send']); ?></td>
        </tr>
    <?php } }catch(PDOException $e){echo $e;} ?>
    </table>
</article>
 
<?php include 'html/footer.php'; ?>