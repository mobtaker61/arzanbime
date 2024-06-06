<?php 
$title = "Manage Posts";
?>
<div class="row">
    <div class="col-12">
        <h1>Posts</h1>
        <a href="/admin/posts/create" class="btn btn-primary">Create New Post</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Image</th>
                    <th>Post Type</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['caption']; ?></td>
                        <td><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="img-thumbnail" width="100"></td>
                        <td><?php echo $post['post_type']; ?></td>
                        <td><?php echo $post['is_active'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="/admin/posts/edit/<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="/admin/posts/delete/<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
