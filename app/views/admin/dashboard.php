        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['caption']; ?></td>
                        <td>
                            <a href="/admin/edit-post/<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="/admin/delete-post/<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
