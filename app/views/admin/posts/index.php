<?php 
$title = "مدیریت محتوا";
?>
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="mb-0"><?php echo $title; ?></h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <a href="/admin/posts/create" class="btn btn-primary">Create New Post</a>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link post-filter" data-type="1" href="#">Guides</a>
            </li>
            <li class="nav-item">
                <a class="nav-link post-filter" data-type="2" href="#">Notices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link post-filter" data-type="3" href="#">FAQs</a>
            </li>
        </ul>
        <div id="posts-container">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Caption</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="posts-table-body">
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="img-thumbnail" width="100"></td>
                            <td><?php echo $post['title']; ?></td>
                            <td><?php echo $post['caption']; ?></td>
                            <td><?php echo $post['is_active'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <a href="/admin/posts/edit/<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="/admin/posts/delete/<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <!-- Pagination links will be inserted here by JavaScript -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const postFilterLinks = document.querySelectorAll('.post-filter');
    postFilterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const postType = this.getAttribute('data-type');
            fetchPosts(postType, 1);
        });
    });

    function fetchPosts(postType, page) {
        fetch(`/admin/posts/type/${postType}?page=${page}&limit=10`)
            .then(response => response.json())
            .then(data => {
                const postsTableBody = document.getElementById('posts-table-body');
                postsTableBody.innerHTML = '';
                data.posts.forEach(post => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><img src="${post.image}" alt="${post.title}" class="img-thumbnail" width="100"></td>
                        <td>${post.title}</td>
                        <td>${post.caption}</td>
                        <td>${post.is_active ? 'Yes' : 'No'}</td>
                        <td>
                            <a href="/admin/posts/edit/${post.id}" class="btn btn-warning">Edit</a>
                            <a href="/admin/posts/delete/${post.id}" class="btn btn-danger">Delete</a>
                        </td>
                    `;
                    postsTableBody.appendChild(row);
                });
                updatePagination(data.page, data.totalPosts, data.limit, postType);
            })
            .catch(error => console.error('Error fetching posts:', error));
    }

    function updatePagination(currentPage, totalPosts, limit, postType) {
        const totalPages = Math.ceil(totalPosts / limit);
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.classList.add('page-item');
            if (i === currentPage) {
                pageItem.classList.add('active');
            }

            const pageLink = document.createElement('a');
            pageLink.classList.add('page-link');
            pageLink.href = "#";
            pageLink.textContent = i;
            pageLink.addEventListener('click', function(e) {
                e.preventDefault();
                fetchPosts(postType, i);
            });

            pageItem.appendChild(pageLink);
            paginationContainer.appendChild(pageItem);
        }
    }

    // Initial fetch for the first type and page 1
    fetchPosts(1, 1);
});
</script>
