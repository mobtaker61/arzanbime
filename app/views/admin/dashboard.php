<?php $view = "../app/views/layouts/master.php"; ?>
<div class="row">
    <h1>Admin Dashboard</h1>
    <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <h2><?php echo $post['title']; ?></h2>
            <p><?php echo $post['body']; ?></p>
        </div>
    <?php endforeach; ?>
</div>
