<?php 
$title = $post['title'] . " - وبلاگ";
$description = substr(strip_tags($post['full_body']), 0, 150);
$keywords = "پست, وبلاگ, " . $post['title'];

?>
<article>
    <h1><?php echo $post['title']; ?></h1>
    <p><?php echo $post['caption']; ?></p>
    <div><?php echo $post['full_body']; ?></div>
</article>
