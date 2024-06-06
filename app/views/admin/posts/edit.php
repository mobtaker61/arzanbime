<?php 
$title = "Edit Post";
?>
<div class="row">
    <div class="col-12">
        <h1>Edit Post</h1>
        <form action="/admin/posts/update/<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_type">Post Type</label>
                <select name="post_type" id="post_type" class="form-control">
                    <?php foreach ($postTypes as $type): ?>
                        <option value="<?php echo $type['id']; ?>" <?php echo $type['id'] == $post['post_type'] ? 'selected' : ''; ?>>
                            <?php echo $type['title']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $post['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" value="<?php echo $post['caption']; ?>" required>
            </div>
            <div class="form-group">
                <label for="full_body">Full Body</label>
                <textarea name="full_body" id="full_body" class="form-control" rows="5" required><?php echo $post['full_body']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <?php if ($post['image']): ?>
                    <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="img-thumbnail mt-2" width="150">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="checkbox" name="is_active" id="is_active" <?php echo $post['is_active'] ? 'checked' : ''; ?>>
                <label for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</div>
