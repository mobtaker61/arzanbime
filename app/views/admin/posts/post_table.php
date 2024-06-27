<table class="table table-striped">
    <thead>
        <tr>
            <th>نوع</th>
            <th>تصویر</th>
            <th>عنوان</th>
            <th>وضعیت</th>
            <th>اقدام</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><span class="badge text-bg-<?php echo $post['color']; ?>"><?php echo $post['postType']; ?></span></td>
                <td><img width="64px" src="<?php echo $post['image']; ?>" alt="عکس مقاله" class="object-cover" /></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['is_active'] ? '🟢' : '🔴'; ?></td>
                <td>
                    <a href="/admin/posts/edit/<?php echo $post['id']; ?>" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-danger delete-post" data-id="<?php echo $post['id']; ?>" title="Delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($totalPosts / $limit); $i++) : ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
