<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Caption</th>
            <th>Post Type</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['caption']; ?></td>
                <td><?php echo $post['post_type']; ?></td>
                <td><?php echo $post['is_active'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="/admin/posts/edit/<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger delete-post" data-id="<?php echo $post['id']; ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalPosts / $limit); $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

