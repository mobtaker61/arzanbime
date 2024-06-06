<?php 
$title = "صفحه اصلی - وبلاگ";
$description = "این صفحه اصلی وبلاگ است که آخرین پست ها و اخبار را نمایش می دهد.";
$keywords = "صفحه اصلی, وبلاگ, اخبار, پست ها";

?>
<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <h2><?php echo $post['title']; ?></h2>
            <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
            <p><?php echo $post['caption']; ?></p>
            <a href="/post/<?php echo $post['id']; ?>">Read more</a>
        </div>
    <?php endforeach; ?>
</div>
