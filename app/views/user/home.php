<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <h2><?php echo $post['title']; ?></h2>
            <p><?php echo $post['body']; ?></p>
        </div>
    <?php endforeach; ?>
</div>
