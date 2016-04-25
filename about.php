<?php 
include 'html/header.php';
$profile = new Profile($conn);
$profile->author_id = $user_id_from_url;

?>
<article>
    <section id="user_info">
       this is about
    </section>
</article>

 
<?php include 'html/footer.php'; ?>