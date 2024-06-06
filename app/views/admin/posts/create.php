<?php 
$title = "Create Post";
?>
<div class="row">
    <div class="col-12">
        <h1>Create Post</h1>
        <form action="/admin/posts/store" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_type">Post Type</label>
                <select name="post_type" id="post_type" class="form-control">
                    <?php foreach ($postTypes as $type): ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="full_body">Full Body</label>
                <textarea name="full_body" id="full_body" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
                <input type="checkbox" name="is_active" id="is_active">
                <label for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</div>
